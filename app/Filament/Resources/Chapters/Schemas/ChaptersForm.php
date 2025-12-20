<?php

namespace App\Filament\Resources\Chapters\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class ChaptersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("numero")
                    ->label("Numéro")
                    ->numeric()
                    ->unique()
                    ->required(),

                RichEditor::make("description")
                    ->required()
                    ->columnSpanFull(),

                Repeater::make("learningObjectives")
                    ->required()
                    ->columnSpanFull()
                    ->relationship()
                    ->columns(3)
                    ->components([
                        ToggleButtons::make("rang")
                        ->label("Rang de la connaisance")
                        ->required()
                        ->grouped()
                        ->options([
                            "A"=>"A",
                            "B"=>"B"
                        ]),
                        Select::make("rubrique")
                        ->label("Rubrique")
                        ->options([
                            "Définition",
                            "Prise En Charge",
                            "Evaluation",
                            "Epidémiologie",
                            "Physiopathologie",
                            "Diagnostic Positif",
                            "Suivi et/ou pronostic",
                            "Identifier une urgence",
                            "Contenu multimédia",
                            "Étiologies",
                            "Examens complémentaires"
                        ])
                        ->columnSpan(2),

                        TextInput::make("intitule")
                        ->required()
                        ->columnSpanFull()
                    ])
                    
            ]);
    }
}
