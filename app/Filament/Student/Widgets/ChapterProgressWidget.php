<?php

namespace App\Filament\Student\Widgets;

use App\Models\Attempt;
use App\Models\Chapter;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class ChapterProgressWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Progression par chapitre';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Chapter::query()
                    ->whereHas('questions', fn ($q) => $q->finalized())
                    ->orderBy('numero')
            )
            ->columns([
                Tables\Columns\TextColumn::make('numero')
                    ->label('Item')
                    ->formatStateUsing(fn ($state) => "Item {$state}")
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(60)
                    ->wrap(),

                Tables\Columns\TextColumn::make('qi_count')
                    ->label('QI')
                    ->state(function (Chapter $record) {
                        return $record->questions()->finalized()->questionIsolee()->count();
                    })
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('progress')
                    ->label('Progression')
                    ->state(function (Chapter $record) {
                        $userId = Auth::id();
                        $totalQI = $record->questions()->finalized()->questionIsolee()->count();

                        if ($totalQI === 0) {
                            return '-';
                        }

                        $answered = Attempt::where('user_id', $userId)
                            ->whereHas('question', fn ($q) => $q->where('chapter_id', $record->id)->questionIsolee())
                            ->distinct('question_id')
                            ->count('question_id');

                        return "{$answered}/{$totalQI}";
                    }),

                Tables\Columns\TextColumn::make('score')
                    ->label('Score moyen')
                    ->state(function (Chapter $record) {
                        $userId = Auth::id();
                        $avgScore = Attempt::where('user_id', $userId)
                            ->whereHas('question', fn ($q) => $q->where('chapter_id', $record->id))
                            ->avg('score');

                        return $avgScore !== null ? number_format($avgScore, 1).'%' : '-';
                    })
                    ->badge()
                    ->color(function (Chapter $record) {
                        $userId = Auth::id();
                        $avgScore = Attempt::where('user_id', $userId)
                            ->whereHas('question', fn ($q) => $q->where('chapter_id', $record->id))
                            ->avg('score');

                        if ($avgScore === null) {
                            return 'gray';
                        }

                        return $avgScore >= 50 ? 'success' : 'danger';
                    }),
            ])
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(10);
    }
}
