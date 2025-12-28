<?php

namespace App\Filament\Student\Resources\Dossiers\Pages;

use App\Filament\Student\Resources\Dossiers\DossierResource;
use App\Models\Attempt;
use App\Models\Dossier;
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
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;

class AnswerDossier extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = DossierResource::class;

    protected static ?string $title = 'Répondre au dossier';

    protected string $view = 'filament.student.pages.answer-dossier';

    public ?array $data = [];

    public Dossier $record;

    public array $questions = [];

    #[Url]
    public int $currentQuestionIndex = 0;

    public array $sessionScores = [];

    public function mount(int|string $record): void
    {
        $this->record = Dossier::with(['questions' => function ($query) {
            $query->orderBy('dossier_order')->finalized();
        }])->findOrFail($record);

        $this->questions = $this->record->questions->toArray();

        if (empty($this->questions)) {
            Notification::make()
                ->title('Dossier vide')
                ->body('Ce dossier ne contient aucune question finalisée.')
                ->warning()
                ->send();

            $this->redirect(DossierResource::getUrl('index'));

            return;
        }

        $this->form->fill();
    }

    public function getCurrentQuestion(): ?array
    {
        return $this->questions[$this->currentQuestionIndex] ?? null;
    }

    public function form(Schema $schema): Schema
    {
        $question = $this->getCurrentQuestion();

        if (! $question) {
            return $schema->components([]);
        }

        $questionType = strval($question['type']);
        $expectedAnswer = is_string($question['expected_answer'])
            ? json_decode($question['expected_answer'], true)
            : $question['expected_answer'];

        return $schema
            ->components([
                // Énoncé du dossier (collapsible après la première question)
                Section::make('Énoncé du dossier')
                    ->schema([
                        Html::make(fn () => $this->record->body),
                    ])
                    ->collapsible()
                    ->collapsed($this->currentQuestionIndex > 0),

                // Question actuelle
                Section::make('Question '.($this->currentQuestionIndex + 1).'/'.count($this->questions))
                    ->description(match ($questionType) {
                        '0' => 'QCM/QRU/QRP',
                        '1' => 'QROC',
                        '2' => 'QZONE',
                        default => ''
                    })
                    ->schema([
                        Html::make(fn () => $question['body']),
                    ]),

                // Section QCM
                Section::make('Vos réponses')
                    ->description('Cochez les propositions que vous considérez vraies')
                    ->schema([
                        Form::make()
                            ->schema([
                                CheckboxList::make('selected_answers')
                                    ->label('')
                                    ->options(function () use ($expectedAnswer) {
                                        $options = [];
                                        foreach ($expectedAnswer ?? [] as $index => $answer) {
                                            $letter = chr(65 + $index);
                                            $options[$index] = "{$letter}. {$answer['proposition']}";
                                        }

                                        return $options;
                                    })
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
                                    ->placeholder('Tapez votre réponse ici...'),
                            ]),
                    ])
                    ->visible(fn () => $questionType === '1'),

                // Section QZONE (placeholder)
                Section::make('Zone de réponse')
                    ->schema([
                        Html::make(fn () => '<div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg text-yellow-700 dark:text-yellow-300">
                            <p class="font-medium">Type de question non encore supporté</p>
                            <p class="text-sm">Les questions de type QZONE seront disponibles prochainement.</p>
                        </div>'),
                    ])
                    ->visible(fn () => $questionType === '2'),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        $isLastQuestion = $this->currentQuestionIndex >= count($this->questions) - 1;

        $actions = [];

        if ($this->currentQuestionIndex > 0) {
            $actions[] = Action::make('previous')
                ->label('Question précédente')
                ->action('previousQuestion')
                ->color('gray')
                ->icon('heroicon-o-arrow-left');
        }

        $actions[] = Action::make('submit')
            ->label($isLastQuestion ? 'Terminer le dossier' : 'Question suivante')
            ->action('submitAndNext')
            ->color('primary')
            ->icon($isLastQuestion ? 'heroicon-o-check' : 'heroicon-o-arrow-right')
            ->iconPosition('after');

        $actions[] = Action::make('cancel')
            ->label('Quitter')
            ->url(DossierResource::getUrl('index'))
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Quitter le dossier')
            ->modalDescription('Vos réponses en cours seront perdues. Êtes-vous sûr de vouloir quitter ?')
            ->modalSubmitActionLabel('Oui, quitter')
            ->modalCancelActionLabel('Non, continuer');

        return $actions;
    }

    public function previousQuestion(): void
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
            $this->form->fill();
        }
    }

    public function submitAndNext(): void
    {
        $data = $this->form->getState();
        $question = $this->getCurrentQuestion();
        $questionType = strval($question['type']);

        $score = 0;
        $isCorrect = false;
        $answers = [];

        $expectedAnswer = is_string($question['expected_answer'])
            ? json_decode($question['expected_answer'], true)
            : $question['expected_answer'];

        if ($questionType === '0') {
            // QCM
            $selectedAnswers = $data['selected_answers'] ?? [];
            $answers = $selectedAnswers;

            $correctAnswers = [];
            foreach ($expectedAnswer ?? [] as $index => $answer) {
                if ($answer['vrai'] ?? false) {
                    $correctAnswers[] = $index;
                }
            }

            $isCorrect = empty(array_diff($correctAnswers, $selectedAnswers)) &&
                         empty(array_diff($selectedAnswers, $correctAnswers));
            $score = $isCorrect ? 100 : 0;

        } elseif ($questionType === '1') {
            // QROC
            $qrocAnswer = strtolower(trim($data['qroc_answer'] ?? ''));
            $answers = ['text' => $data['qroc_answer'] ?? ''];

            if (is_array($expectedAnswer)) {
                $acceptedAnswers = [];
                foreach ($expectedAnswer as $answer) {
                    if (isset($answer['proposition'])) {
                        $acceptedAnswers[] = strtolower(trim($answer['proposition']));
                    } elseif (is_string($answer)) {
                        $acceptedAnswers[] = strtolower(trim($answer));
                    }
                }
                $isCorrect = in_array($qrocAnswer, $acceptedAnswers);
            }

            $score = $isCorrect ? 100 : 0;
        }

        // Sauvegarder la tentative
        Attempt::create([
            'question_id' => $question['id'],
            'user_id' => Auth::id(),
            'answers' => $answers,
            'score' => $score,
            'is_correct' => $isCorrect,
        ]);

        $this->sessionScores[$this->currentQuestionIndex] = [
            'score' => $score,
            'is_correct' => $isCorrect,
        ];

        // Vérifier si c'est la dernière question
        if ($this->currentQuestionIndex >= count($this->questions) - 1) {
            $this->completeDossier();
        } else {
            $this->currentQuestionIndex++;
            $this->form->fill();
        }
    }

    protected function completeDossier(): void
    {
        $totalScore = 0;
        $correctCount = 0;

        foreach ($this->sessionScores as $result) {
            $totalScore += $result['score'];
            if ($result['is_correct']) {
                $correctCount++;
            }
        }

        $averageScore = count($this->sessionScores) > 0
            ? round($totalScore / count($this->sessionScores), 1)
            : 0;

        Notification::make()
            ->title('Dossier terminé !')
            ->body("Score: {$correctCount}/".count($this->questions)." ({$averageScore}%)")
            ->success()
            ->send();

        $this->redirect(DossierResource::getUrl('view', ['record' => $this->record]));
    }

    public function getProgressPercentage(): float
    {
        if (count($this->questions) === 0) {
            return 0;
        }

        return round(($this->currentQuestionIndex / count($this->questions)) * 100, 1);
    }
}
