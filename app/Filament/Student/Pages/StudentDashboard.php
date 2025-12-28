<?php

namespace App\Filament\Student\Pages;

use App\Models\Attempt;
use App\Models\Matiere;
use Filament\Pages\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use BackedEnum;

class StudentDashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'filament.student.pages.dashboard';

    protected static ?string $title = 'Tableau de bord';

    protected static ?string $navigationLabel = 'Accueil';

    protected static ?int $navigationSort = -2;

    public Collection $matieres;

    public array $userStats;

    public function mount(): void
    {
        $userId = Auth::id();

        $this->matieres = Matiere::with(['chapters' => function ($query) {
            $query->whereHas('questions', fn ($q) => $q->finalized());
        }, 'chapters.questions' => function ($query) {
            $query->finalized();
        }])->whereHas('chapters.questions', fn ($q) => $q->finalized())->get();

        $this->userStats = $this->getUserStats($userId);
    }

    protected function getUserStats(int $userId): array
    {
        $attempts = Attempt::where('user_id', $userId)->get();

        return [
            'total_attempts' => $attempts->count(),
            'correct_attempts' => $attempts->where('is_correct', true)->count(),
            'average_score' => $attempts->count() > 0 ? round($attempts->avg('score'), 1) : 0,
            'unique_questions' => $attempts->unique('question_id')->count(),
        ];
    }
}
