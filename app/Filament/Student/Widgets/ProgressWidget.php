<?php

namespace App\Filament\Student\Widgets;

use App\Models\Attempt;
use App\Models\Question;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ProgressWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $userId = Auth::id();
        $attempts = Attempt::where('user_id', $userId)->get();
        $totalQuestions = Question::finalized()->questionIsolee()->count();
        $answeredQuestions = $attempts->unique('question_id')->count();
        $correctAttempts = $attempts->where('is_correct', true)->count();
        $successRate = $attempts->count() > 0
            ? round(($correctAttempts / $attempts->count()) * 100, 1)
            : 0;

        return [
            Stat::make('Questions répondues', $answeredQuestions.'/'.$totalQuestions)
                ->description('Progression globale')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary')
                ->chart($this->getProgressChart($userId)),

            Stat::make('Taux de réussite', $successRate.'%')
                ->description($correctAttempts.' réponses correctes')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color($successRate >= 50 ? 'success' : 'danger'),

            Stat::make('Score moyen', round($attempts->avg('score') ?? 0, 1).'%')
                ->description('Sur '.$attempts->count().' tentatives')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning'),
        ];
    }

    protected function getProgressChart(int $userId): array
    {
        // Récupérer les 7 derniers jours de tentatives
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $count = Attempt::where('user_id', $userId)
                ->whereDate('created_at', $date)
                ->count();
            $data[] = $count;
        }

        return $data;
    }
}
