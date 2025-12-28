<?php

namespace App\Filament\Student\Resources\Dossiers\Tables;

use App\Filament\Student\Resources\Dossiers\DossierResource;
use App\Models\Attempt;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DossiersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(),

                TextColumn::make('questions_count')
                    ->label('Questions')
                    ->counts('questions')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('chapter')
                    ->label('Chapitre')
                    ->state(function ($record) {
                        $chapter = $record->questions()->first()?->chapter;

                        return $chapter ? "Item {$chapter->numero}" : '-';
                    }),

                IconColumn::make('completion_status')
                    ->label('Statut')
                    ->icon(function ($record) {
                        $userId = Auth::id();
                        $questionIds = $record->questions()->pluck('id');
                        $attemptsCount = Attempt::where('user_id', $userId)
                            ->whereIn('question_id', $questionIds)
                            ->distinct('question_id')
                            ->count('question_id');

                        if ($attemptsCount === 0) {
                            return 'heroicon-o-minus-circle';
                        }
                        if ($attemptsCount >= $questionIds->count()) {
                            return 'heroicon-o-check-circle';
                        }

                        return 'heroicon-o-clock';
                    })
                    ->color(function ($record) {
                        $userId = Auth::id();
                        $questionIds = $record->questions()->pluck('id');
                        $attemptsCount = Attempt::where('user_id', $userId)
                            ->whereIn('question_id', $questionIds)
                            ->distinct('question_id')
                            ->count('question_id');

                        if ($attemptsCount === 0) {
                            return 'gray';
                        }
                        if ($attemptsCount >= $questionIds->count()) {
                            return 'success';
                        }

                        return 'warning';
                    }),

                TextColumn::make('last_score')
                    ->label('Dernier score')
                    ->state(function ($record) {
                        $userId = Auth::id();
                        $questionIds = $record->questions()->pluck('id');
                        $avgScore = Attempt::where('user_id', $userId)
                            ->whereIn('question_id', $questionIds)
                            ->avg('score');

                        return $avgScore !== null ? number_format($avgScore, 1).'%' : '-';
                    })
                    ->badge()
                    ->color(function ($record) {
                        $userId = Auth::id();
                        $questionIds = $record->questions()->pluck('id');
                        $avgScore = Attempt::where('user_id', $userId)
                            ->whereIn('question_id', $questionIds)
                            ->avg('score');

                        if ($avgScore === null) {
                            return 'gray';
                        }

                        return $avgScore >= 50 ? 'success' : 'danger';
                    }),
            ])
            ->filters([])
            ->recordAction(null)
            ->recordUrl(fn ($record) => DossierResource::getUrl('answer', ['record' => $record]))
            ->actions([
                Action::make('answer')
                    ->label('Commencer')
                    ->icon('heroicon-o-play')
                    ->color('primary')
                    ->url(fn ($record) => DossierResource::getUrl('answer', ['record' => $record])),

                Action::make('view')
                    ->label('Résultats')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->url(fn ($record) => DossierResource::getUrl('view', ['record' => $record]))
                    ->visible(function ($record) {
                        $userId = Auth::id();

                        return Attempt::where('user_id', $userId)
                            ->whereIn('question_id', $record->questions()->pluck('id'))
                            ->exists();
                    }),
            ])
            ->bulkActions([]);
    }
}
