<?php

namespace App\Filament\Student\Resources\Dossiers\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Schema;

class DossierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations du dossier')
                    ->schema([
                        Placeholder::make('title')
                            ->label('Titre')
                            ->content(fn ($record) => $record?->title ?? '-'),

                        Placeholder::make('questions_count')
                            ->label('Nombre de questions')
                            ->content(fn ($record) => $record?->questions()->count() ?? 0),
                    ])->columns(2),

                Section::make('Énoncé du dossier')
                    ->schema([
                        ViewField::make('body')
                            ->label('')
                            ->view('filament.forms.components.html-content'),
                    ]),
            ]);
    }
}
