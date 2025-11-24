<?php

namespace App\Filament\Student\Resources\Questions\Pages;

use App\Filament\Student\Resources\Questions\QuestionResource;
use App\Models\Attempt;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AnswerQuestion extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected static string $resource = QuestionResource::class;

    protected string $view = 'filament.student.pages.answer-question';

    public ?array $data = [];
    
    public $record;

    public function mount(int | string $record): void
    {
        $this->record = static::getResource()::resolveRecordRouteBinding($record);
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        $record = $this->record;
        
        return $schema
            ->components([
                Section::make('Question')
                    ->description("Item {$record->chapter?->numero} - " . match(strval($record->type)) {
                        '0' => 'QCM/QRU/QRP',
                        '1' => 'QROC',
                        '2' => 'QZONE',
                        default => 'Inconnu'
                    })
                    ->schema([
                        \Filament\Schemas\Components\Html::make(fn () => $record->body),
                    ])
                    ->collapsible()
                    ->persistCollapsed(),
                
                Section::make('Vos réponses')
                    ->description('Cochez les propositions que vous considérez vraies')
                    ->schema([
                        \Filament\Schemas\Components\Form::make()
                            ->schema([
                                \Filament\Forms\Components\CheckboxList::make('selected_answers')
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
                    ->visible(fn () => strval($record->type) === '0'),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('submit')
                ->label('Valider mes réponses')
                ->action('submitAnswer')
                ->color('primary'),
            
            Action::make('cancel')
                ->label('Retour')
                ->url(QuestionResource::getUrl('index'))
                ->color('gray'),
        ];
    }

    public function submitAnswer(): void
    {
        $data = $this->form->getState();
        $selectedAnswers = $data['selected_answers'] ?? [];
        
        // Calculer le score
        $correctAnswers = [];
        foreach ($this->record->expected_answer as $index => $answer) {
            if ($answer['vrai'] ?? false) {
                $correctAnswers[] = $index;
            }
        }
        
        $isCorrect = empty(array_diff($correctAnswers, $selectedAnswers)) && 
                     empty(array_diff($selectedAnswers, $correctAnswers));
        
        $score = $isCorrect ? 100 : 0;
        
        // Enregistrer la tentative
        Attempt::create([
            'question_id' => $this->record->id,
            'user_id' => Auth::id(),
            'answers' => $selectedAnswers,
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
        $this->redirect(QuestionResource::getUrl('view', ['record' => $this->record]));
    }
}
