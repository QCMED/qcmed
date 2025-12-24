<?php

namespace App\Filament\Resources\Chapters\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class ChaptersForm
{
    public static function schemaArray(): array
    {
        return [
            TextInput::make('numero')
                ->label('Numéro')
                ->numeric()
                ->unique()
                ->required(),
                
            Select::make('matieres')
                ->multiple()
                ->preload()
                ->relationship(titleAttribute:"name"),

            MarkdownEditor::make('description')
                ->required()
                ->columnSpanFull(),

            Repeater::make('learningObjectives')
                ->required()
                ->label("Objectif de connaissance")
                ->columnSpanFull()
                ->grid(3)
                ->relationship()
                ->columns(3)
                ->minItems(1)
                ->itemLabel(fn (array $state): ?string => $state['intitule'] ?? null)
                ->schema([
                    ToggleButtons::make('rang')
                        ->label('Rang')
                        ->required()
                        ->grouped()
                        ->options([
                            'A' => 'A',
                            'B' => 'B',
                        ]),
                    Select::make('rubrique')
                        ->label('Rubrique')
                        ->required()
                        ->options([
                            'Définition' => 'Définition',
                            'Prise en charge' => 'Prise en charge',
                            'Evaluation' => 'Evaluation',
                            'Epidémiologie' => 'Epidémiologie',
                            'Physiopathologie' => 'Physiopathologie',
                            'Diagnostic positif' => 'Diagnostic positif',
                            'Suivi et/ou pronostic' => 'Suivi et/ou pronostic',
                            'Identifier une urgence' => 'Identifier une urgence',
                            'Contenu multimédia' => 'Contenu multimédia',
                            'Étiologies' => 'Étiologies',
                            'Examens complémentaires' => 'Examens complémentaires',
                        ])
                        ->columnSpan(2),

                    TextArea::make('intitule')
                        ->required()
                        ->columnSpanFull(),
                ]),

        ];
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(self::schemaArray());
    }
}
