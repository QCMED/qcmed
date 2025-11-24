<?php

namespace App\Filament\Student\Resources\Questions\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
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
                    ->formatStateUsing(fn ($state) => match(strval($state)) {
                        '0' => 'QCM/QRU/QRP',
                        '1' => 'QROC',
                        '2' => 'QZONE',
                        default => 'Inconnu'
                    })
                    ->color(fn ($state) => match(strval($state)) {
                        '0' => 'success',
                        '1' => 'info',
                        '2' => 'warning',
                        default => 'gray'
                    }),
            ])
            ->filters([
                //
            ])
            ->recordAction(null)
            ->recordUrl(fn ($record) => \App\Filament\Student\Resources\Questions\QuestionResource::getUrl('answer', ['record' => $record]))
            ->toolbarActions([
                //
            ]);
    }
}
