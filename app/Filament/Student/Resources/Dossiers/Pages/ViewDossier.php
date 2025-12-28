<?php

namespace App\Filament\Student\Resources\Dossiers\Pages;

use App\Filament\Student\Resources\Dossiers\DossierResource;
use App\Models\Attempt;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ViewDossier extends Page
{
    protected static string $resource = DossierResource::class;

    protected static ?string $title = 'Résultats du dossier';

    protected string $view = 'filament.student.pages.view-dossier';

    public $record;

    public $questionsWithAttempts;

    public int $totalCorrect = 0;

    public int $totalQuestions = 0;

    public float $averageScore = 0;

    public function mount(int|string $record): void
    {
        $this->record = static::getResource()::resolveRecordRouteBinding($record);

        $userId = Auth::id();
        $questions = $this->record->questions()->orderBy('dossier_order')->get();

        $this->questionsWithAttempts = $questions->map(function ($question) use ($userId) {
            $lastAttempt = Attempt::where('question_id', $question->id)
                ->where('user_id', $userId)
                ->latest()
                ->first();

            return [
                'question' => $question,
                'attempt' => $lastAttempt,
            ];
        });

        $this->totalQuestions = $questions->count();
        $this->totalCorrect = $this->questionsWithAttempts->filter(fn ($item) => $item['attempt']?->is_correct)->count();
        $this->averageScore = $this->questionsWithAttempts->avg(fn ($item) => $item['attempt']?->score ?? 0) ?? 0;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('retry')
                ->label('Refaire le dossier')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->url(DossierResource::getUrl('answer', ['record' => $this->record])),

            Action::make('back')
                ->label('Retour aux dossiers')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(DossierResource::getUrl('index')),
        ];
    }
}
