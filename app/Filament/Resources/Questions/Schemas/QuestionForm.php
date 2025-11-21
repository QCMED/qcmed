<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Models\Chapter;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;


class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("name"),

                RichEditor::make("body"),



                Select::make("chapter_id")
                    ->label("Chapitre")
                    ->options(function () {
                        return Chapter::query()
                            ->get()
                            ->mapWithKeys(fn ($chapter) => [
                                $chapter->id => "Item {$chapter->numero} - " . \Illuminate\Support\Str::limit($chapter->description, 80)
                            ]);
                    })
                    ->searchable()
                    ->loadingMessage('Chargement des chapitres...')
                    ->noSearchResultsMessage('Pas de chapitre trouvé.')
                    ->optionsLimit(10),


                Select::make("type")
                    ->options([
                        "0" => "QCM/QRU/QRP",
                        "1" => "QROC",
                        "2" => "QZONE",
                    ])
                    ->default("0")
                    ->live(),
                
                
                Grid::make(1)
                    ->schema(fn (Get $get): array => match ($get('type')) {
                        "0" => [
                            Repeater::make("expected_answer")
                            ->schema([
                                TextInput::make("lettre")
                                ->distinct()
                                ->disabled()
                                ->default("A"),
                                TextInput::make("texte"),
                                TextInput::make("correction"),
                                
                            ])
                            ->live()
                            ->defaultItems(4)
                            ->minItems(4)
                            ->maxItems(20)
                            ->columns(3),


                    ],
                        "2" => [FileUpload::make("image"),],
                        "1" => [TextInput::make("expected_answer")],
                        
                    }),
            
            ]);
    }
}
