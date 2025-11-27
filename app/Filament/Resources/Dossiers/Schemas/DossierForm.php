<?php

namespace App\Filament\Resources\Dossiers\Schemas;

use App\Filament\Resources\Questions\QuestionResource;
use App\Filament\Resources\Questions\Schemas\QuestionForm;
use Barryvdh\Debugbar\Facades\Debugbar;
use Closure;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class DossierForm
{
    public static function configure(Schema $schema): Schema
    {   
        $questionFormSchema = QuestionForm::schemaArray();
        unset($questionFormSchema[2]);

        return $schema
            ->columns(6)
            ->components([
                TextInput::make("title")
                    ->required()
                    ->columnSpan(4),

                ToggleButtons::make('status')
                    ->options([
                        '0' => 'Brouillon',
                        '1' => 'En révisions',
                        '2' => 'Finie'
                    ])
                    ->grouped()
                    ->live()
                    ->required()
                    ->columnSpan(2),
                
                RichEditor::make("description")
                    ->columnSpanFull()
                    ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                ['bulletList', 'orderedList'],
                                ['attachFiles'], // The `customBlocks` and `mergeTags` tools are also added here if those features are used.
                                ['undo', 'redo'],
                            ]),

                Repeater::make("questions")
                    ->relationship()
                    ->schema($questionFormSchema)
                    ->orderColumn("dossier_order")
                    ->reorderable()
                    ->reorderableWithButtons()
                    ->columnSpanFull()
                    ->collapsible()
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data, Get $get): array {
                        $data['user_id'] = Auth::id();
                        $data['status'] = $get("../../status");
                        return $data;
                    })
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data, Get $get): array {
                        $data['user_id'] = Auth::id();
                        $data['status'] = $get("../../status");
                        return $data;
                    })
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
