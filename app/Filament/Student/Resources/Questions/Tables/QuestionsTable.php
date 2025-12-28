<?php

namespace App\Filament\Student\Resources\Questions\Tables;

use App\Models\Attempt;
use App\Models\Chapter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class QuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->questionIsolee()->finalized())
            ->columns([
                TextColumn::make('chapter.numero')
                    ->label('Item')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => "Item {$state}")
                    ->weight('bold'),

                TextColumn::make('title')
                    ->label('Question')
                    ->searchable()
                    ->grow()
                    ->wrap(),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match (strval($state)) {
                        '0' => 'QCM/QRU/QRP',
                        '1' => 'QROC',
                        '2' => 'QZONE',
                        default => 'Inconnu'
                    })
                    ->color(fn ($state) => match (strval($state)) {
                        '0' => 'success',
                        '1' => 'info',
                        '2' => 'warning',
                        default => 'gray'
                    }),

                IconColumn::make('attempt_status')
                    ->label('Statut')
                    ->icon(function ($record) {
                        $attempt = Attempt::where('question_id', $record->id)
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->first();

                        if (! $attempt) {
                            return 'heroicon-o-minus-circle';
                        }

                        return $attempt->is_correct ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle';
                    })
                    ->color(function ($record) {
                        $attempt = Attempt::where('question_id', $record->id)
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->first();

                        if (! $attempt) {
                            return 'gray';
                        }

                        return $attempt->is_correct ? 'success' : 'danger';
                    }),

                TextColumn::make('attempts_count')
                    ->label('Tentatives')
                    ->state(function ($record) {
                        return Attempt::where('question_id', $record->id)
                            ->where('user_id', Auth::id())
                            ->count();
                    })
                    ->badge()
                    ->color('primary'),
            ])
            ->filters([
                SelectFilter::make('chapter_id')
                    ->label('Item')
                    ->options(fn () => Chapter::query()
                        ->whereHas('questions', fn ($q) => $q->questionIsolee()->finalized())
                        ->get()
                        ->mapWithKeys(fn ($chapter) => [$chapter->id => "Item {$chapter->numero}"])
                    ),

                SelectFilter::make('attempt_status')
                    ->label('Statut')
                    ->options([
                        'not_attempted' => 'Non répondu',
                        'correct' => 'Réussi',
                        'incorrect' => 'Échoué',
                    ])
                    ->query(function ($query, array $data) {
                        if (! $data['value']) {
                            return;
                        }

                        $userId = Auth::id();

                        return match ($data['value']) {
                            'not_attempted' => $query->whereDoesntHave('attempts', fn ($q) => $q->where('user_id', $userId)),
                            'correct' => $query->whereHas('attempts', fn ($q) => $q->where('user_id', $userId)->where('is_correct', true)),
                            'incorrect' => $query->whereHas('attempts', fn ($q) => $q->where('user_id', $userId)->where('is_correct', false))
                                ->whereDoesntHave('attempts', fn ($q) => $q->where('user_id', $userId)->where('is_correct', true)),
                            default => $query,
                        };
                    }),
            ])
            ->recordAction(null)
            ->recordUrl(fn ($record) => route('filament.student.resources.questions.answer', ['record' => $record]))
            ->toolbarActions([]);
    }
}
