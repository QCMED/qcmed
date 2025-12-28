<?php

namespace App\Filament\Student\Pages;

use App\Models\Attempt;
use Filament\Pages\Page;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use BackedEnum;

class AttemptsHistory extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    protected string $view = 'filament.student.pages.attempts-history';

    protected static ?string $title = 'Historique des tentatives';

    protected static ?string $navigationLabel = 'Historique';

    protected static ?int $navigationSort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Attempt::query()
                    ->where('user_id', Auth::id())
                    ->with(['question.chapter', 'question.dossier'])
                    ->latest()
            )
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('question.chapter.numero')
                    ->label('Item')
                    ->formatStateUsing(fn ($state) => $state ? "Item {$state}" : '-')
                    ->sortable(),

                TextColumn::make('question_type')
                    ->label('Type')
                    ->state(function (Attempt $record) {
                        if ($record->question->dossier_id) {
                            return 'Dossier';
                        }

                        return 'QI';
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'Dossier' ? 'purple' : 'primary'),

                TextColumn::make('question.dossier.title')
                    ->label('Dossier')
                    ->placeholder('-')
                    ->limit(30)
                    ->wrap(),

                IconColumn::make('is_correct')
                    ->label('Résultat')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('score')
                    ->label('Score')
                    ->formatStateUsing(fn ($state) => number_format($state, 1).'%')
                    ->badge()
                    ->color(fn ($state) => $state >= 50 ? 'success' : 'danger'),
            ])
            ->filters([
                SelectFilter::make('is_correct')
                    ->label('Résultat')
                    ->options([
                        '1' => 'Correct',
                        '0' => 'Incorrect',
                    ]),

                SelectFilter::make('chapter')
                    ->label('Chapitre')
                    ->relationship('question.chapter', 'numero', fn (Builder $query) => $query->orderBy('numero'))
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Item {$record->numero}"),

                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'qi' => 'Questions Isolées',
                        'dossier' => 'Dossiers',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['value'] === 'qi') {
                            return $query->whereHas('question', fn ($q) => $q->whereNull('dossier_id'));
                        }
                        if ($data['value'] === 'dossier') {
                            return $query->whereHas('question', fn ($q) => $q->whereNotNull('dossier_id'));
                        }

                        return $query;
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(25);
    }

    public function getStats(): array
    {
        $userId = Auth::id();
        $attempts = Attempt::where('user_id', $userId)->get();

        $today = Attempt::where('user_id', $userId)
            ->whereDate('created_at', today())
            ->count();

        $thisWeek = Attempt::where('user_id', $userId)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return [
            'total' => $attempts->count(),
            'correct' => $attempts->where('is_correct', true)->count(),
            'today' => $today,
            'this_week' => $thisWeek,
        ];
    }
}
