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
use Filament\Support\Enums\TextSize;
use Illuminate\Support\Facades\Auth;

class AnswerQuestion extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = QuestionResource::class;

    protected string $view = 'filament.student.pages.answer-question';

    public ?array $data = [];

    public $record;

    public function mount(int|string $record): void
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
                    ->schema([
                        \Filament\Schemas\Components\Text::make(fn () => $record->body)
                            ->size(TextSize::Large),
                        
                            \Filament\Schemas\Components\Form::make()
                            
                                ->schema([
                                    \Filament\Forms\Components\CheckboxList::make('selected_answers')
                                        ->label("Cochez les propositions vraies")
                                        
                                        ->options(function () use ($record) {
                                            $options = [];
                                            foreach ($record->expected_answer ?? [] as $index => $answer) {
                                                $letter = chr(65 + $index);
                                                $options[$index] = "{$letter}- {$answer['proposition']}";
                                            }

                                            return $options;
                                        })
                                        ->required()
                                        ->markAsRequired(False)
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
        $selectedAnswers = $data['selected_answers'] ;

        // Calculer le score
        $correctAnswers = [];
        foreach ($this->record->expected_answer as $index => $answer) {   //Ce bloc sert à avoir une liste simple avec les bonnes réponses
            if ($answer['vrai'] ?? false) {                               //On pourrait optimiser le temps de calcul de la bonne réponse contre plus d'espace
                $correctAnswers[] = $index;                               //dans la DB en ajoutant une colonne qui contient directement la données sous cette
            }                                                             //forme + simple dans la table des questions
        }                                                                  

        $isCorrect = empty(array_diff($correctAnswers, $selectedAnswers)) && // Pas de différence entre la liste de réponses cochées et la liste de
                     empty(array_diff($selectedAnswers, $correctAnswers));   // réponses vraies

        $score = $isCorrect? True:False;  // Il faudrait un contrôleur pour calculer le nombre de points selon le type de questions

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
                ->body('Bonne réponse.')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Incorrect')
                ->body('Mauvaise réponse.')
                ->warning()
                ->send();
        }

        // Rediriger vers la page de correction
        $this->redirect(QuestionResource::getUrl('view', ['record' => $this->record]));
    }
}
