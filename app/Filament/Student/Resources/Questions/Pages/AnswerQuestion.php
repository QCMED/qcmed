<?php

namespace App\Filament\Student\Resources\Questions\Pages;

use App\Filament\Student\Resources\Questions\QuestionResource;
use App\Models\Attempt;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AnswerQuestion extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = QuestionResource::class;

    protected string $view = 'filament.student.pages.answer-question';

    public ?array $data = [];

    public $record;

    public Collection $previousAttempts;

    public function mount(int|string $record): void
    {
        $this->record = static::getResource()::resolveRecordRouteBinding($record);

        // Charger les tentatives précédentes
        $this->previousAttempts = Attempt::where('question_id', $this->record->id)
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        $record = $this->record;
        $questionType = strval($record->type);

        return $schema
            ->components([
                Section::make('Question')
                    ->description("Item {$record->chapter?->numero} - ".match ($questionType) {
                        '0' => 'QCM/QRU/QRP',
                        '1' => 'QROC',
                        '2' => 'QZONE',
                        default => 'Inconnu'
                    })
                    ->schema([
                        Html::make(fn () => $record->body),
                    ])
                    ->collapsible()
                    ->persistCollapsed(),

                // Section QCM/QRU/QRP
                Section::make('Vos réponses')
                    ->description('Cochez les propositions que vous considérez vraies')
                    ->schema([
                        Form::make()
                            ->schema([
                                CheckboxList::make('selected_answers')
                                    ->label('')
                                    ->options(function () use ($record) {
                                        $options = [];
                                        foreach ($record->expected_answer ?? [] as $index => $answer) {
                                            $letter = chr(65 + $index);
                                            $options[$index] = "{$letter}. {$answer['proposition']}";
                                        }

                                        return $options;
                                    })
                                    ->required()
                                    ->columns(1)
                                    ->gridDirection('row'),
                            ]),
                    ])
                    ->visible(fn () => $questionType === '0'),

                // Section QROC
                Section::make('Votre réponse')
                    ->description('Répondez de manière concise')
                    ->schema([
                        Form::make()
                            ->schema([
                                Textarea::make('qroc_answer')
                                    ->label('')
                                    ->rows(3)
                                    ->required()
                                    ->placeholder('Tapez votre réponse ici...'),
                            ]),
                    ])
                    ->visible(fn () => $questionType === '1'),

                // Section QZONE (placeholder)
                Section::make('Zone de réponse')
                    ->description('Cliquez sur la zone appropriée')
                    ->schema([
                        Html::make(fn () => '<div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg text-yellow-700 dark:text-yellow-300">
                            <p class="font-medium">Type de question non encore supporté</p>
                            <p class="text-sm">Les questions de type QZONE seront disponibles prochainement.</p>
                        </div>'),
                    ])
                    ->visible(fn () => $questionType === '2'),

                // Historique des tentatives
                Section::make('Historique')
                    ->description('Vos dernières tentatives sur cette question')
                    ->schema([
                        Html::make(fn () => $this->renderAttemptsHistory()),
                    ])
                    ->collapsed()
                    ->visible(fn () => $this->previousAttempts->isNotEmpty()),
            ])
            ->statePath('data');
    }

    protected function renderAttemptsHistory(): string
    {
        if ($this->previousAttempts->isEmpty()) {
            return '<p class="text-sm text-gray-500">Aucune tentative précédente.</p>';
        }

        $html = '<div class="space-y-2">';

        foreach ($this->previousAttempts as $attempt) {
            $icon = $attempt->is_correct
                ? '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                : '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';

            $scoreColor = $attempt->score >= 50 ? 'text-green-600' : 'text-red-600';
            $date = $attempt->created_at->format('d/m/Y H:i');

            $html .= "
                <div class=\"flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg\">
                    <div class=\"flex items-center gap-3\">
                        {$icon}
                        <span class=\"text-sm text-gray-600 dark:text-gray-400\">{$date}</span>
                    </div>
                    <span class=\"text-sm font-medium {$scoreColor}\">{$attempt->score}%</span>
                </div>
            ";
        }

        $html .= '</div>';

        return $html;
    }

    protected function getFormActions(): array
    {
        $questionType = strval($this->record->type);

        $actions = [
            Action::make('cancel')
                ->label('Retour')
                ->url(route('filament.student.resources.questions.index'))
                ->color('gray'),
        ];

        // N'afficher le bouton de validation que pour les types supportés
        if (in_array($questionType, ['0', '1'])) {
            array_unshift($actions, Action::make('submit')
                ->label('Valider mes réponses')
                ->action('submitAnswer')
                ->color('primary'));
        }

        return $actions;
    }

    public function submitAnswer(): void
    {
        $data = $this->form->getState();
        $questionType = strval($this->record->type);

        $score = 0;
        $isCorrect = false;
        $answers = [];

        if ($questionType === '0') {
            // QCM/QRU/QRP
            $selectedAnswers = $data['selected_answers'] ?? [];
            $answers = $selectedAnswers;

            $correctAnswers = [];
            foreach ($this->record->expected_answer ?? [] as $index => $answer) {
                if ($answer['vrai'] ?? false) {
                    $correctAnswers[] = $index;
                }
            }

            $isCorrect = empty(array_diff($correctAnswers, $selectedAnswers)) &&
                         empty(array_diff($selectedAnswers, $correctAnswers));
            $score = $isCorrect ? 100 : 0;

        } elseif ($questionType === '1') {
            // QROC - comparaison simple (insensible à la casse)
            $qrocAnswer = strtolower(trim($data['qroc_answer'] ?? ''));
            $answers = ['text' => $data['qroc_answer'] ?? ''];

            // Le expected_answer pour QROC peut être un tableau de réponses acceptées
            $expectedAnswers = $this->record->expected_answer;

            if (is_array($expectedAnswers)) {
                // Si c'est un tableau de propositions comme pour QCM, chercher la bonne réponse
                $acceptedAnswers = [];
                foreach ($expectedAnswers as $answer) {
                    if (isset($answer['proposition'])) {
                        $acceptedAnswers[] = strtolower(trim($answer['proposition']));
                    } elseif (is_string($answer)) {
                        $acceptedAnswers[] = strtolower(trim($answer));
                    }
                }
                $isCorrect = in_array($qrocAnswer, $acceptedAnswers);
            } else {
                // Si c'est une chaîne simple
                $isCorrect = $qrocAnswer === strtolower(trim($expectedAnswers ?? ''));
            }

            $score = $isCorrect ? 100 : 0;
        }

        // Enregistrer la tentative
        Attempt::create([
            'question_id' => $this->record->id,
            'user_id' => Auth::id(),
            'answers' => $answers,
            'score' => $score,
            'is_correct' => $isCorrect,
        ]);

        // Notification
        if ($isCorrect) {
            Notification::make()
                ->title('Bravo !')
                ->body('Votre réponse est correcte.')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Incorrect')
                ->body('Votre réponse n\'est pas correcte. Consultez la correction.')
                ->warning()
                ->send();
        }

        // Rediriger vers la page de correction
        $this->redirect(route('filament.student.resources.questions.view', ['record' => $this->record]));
    }
}
