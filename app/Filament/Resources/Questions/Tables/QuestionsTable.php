<?php

namespace App\Filament\Resources\Questions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class QuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                
                TextColumn::make('chapter.numero')
                    ->label('Item')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => "Item {$state}")
                    ->weight('bold'),
                
                TextColumn::make('title')
                    ->label('Question')
                    ->searchable()
                    ->limit(80)
                    ->wrap()
                    ->grow(),
                
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
                    })
                    ->sortable(),
                
                TextColumn::make('author.name')
                    ->label('Auteur')
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match(strval($state)) {
                        '0' => 'Brouillon',
                        '1' => 'En révision',
                        '2' => 'Finalisée',
                        default => 'Inconnu'
                    })
                    ->color(fn ($state) => match(strval($state)) {
                        '0' => 'gray',
                        '1' => 'warning',
                        '2' => 'success',
                        default => 'danger'
                    })
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Créée le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label('Modifiée le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        '0' => 'QCM/QRU/QRP',
                        '1' => 'QROC',
                        '2' => 'QZONE',
                    ]),
                
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        '0' => 'Brouillon',
                        '1' => 'En révision',
                        '2' => 'Finalisée',
                    ]),
                
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
            ])
            ->defaultSort('created_at', 'desc');
    }
}
