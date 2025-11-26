<?php

namespace App\Filament\Resources\Dossiers\Schemas;

use App\Filament\Resources\Questions\QuestionResource;
use App\Filament\Resources\Questions\Schemas\QuestionForm;
use Barryvdh\Debugbar\Facades\Debugbar;
use Closure;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class DossierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make("questions")
                ->relationship()
                ->schema(QuestionForm::schemaArray())
                ->orderColumn("dossier_order")
                ->reorderable()
                ->reorderableWithButtons()
                ->columnSpanFull()
                ->collapsible()
                ->defaultItems(5)
                ->minItems(3)
                ->maxItems(8)
                ->itemLabel(function (Repeater $component, array $state) :string {
                    $numeroQuestionActuelle = array_search(array_search($state, $component->getState()), array_keys($component->getState()))+1;
                   return "Question ".strval($numeroQuestionActuelle);
                })                
                ,
            ]);
    }
}
