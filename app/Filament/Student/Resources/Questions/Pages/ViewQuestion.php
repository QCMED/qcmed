<?php

namespace App\Filament\Student\Resources\Questions\Pages;

use App\Filament\Student\Resources\Questions\QuestionResource;
use Filament\Resources\Pages\ViewRecord;

class ViewQuestion extends ViewRecord
{
    protected static string $resource = QuestionResource::class;

    protected function getFooterActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label('Retour aux questions')
                ->icon('heroicon-o-arrow-left')
                ->color('primary')
                ->url(route('filament.student.resources.questions.index')),
        ];
    }

    protected function getActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label('Retour aux questions')
                ->icon('heroicon-o-arrow-left')
                ->color('primary')
                ->url(route('filament.student.resources.questions.index')),
        ];
    }
}
