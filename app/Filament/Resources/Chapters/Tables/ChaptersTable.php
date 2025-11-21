<?php

namespace App\Filament\Resources\Chapters\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ChaptersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('numero')
                    ->label('Item')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(100)
                    ->wrap()
                    ->grow(),
                
                TextColumn::make('learningObjectives_count')
                    ->label('Objectifs')
                    ->counts('learningObjectives')
                    ->sortable()
                    ->alignCenter(),
                
                TextColumn::make('questions_count')
                    ->label('Questions')
                    ->counts('questions')
                    ->sortable()
                    ->alignCenter(),
                
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
