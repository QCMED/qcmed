<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Models\Chapter;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
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
                    ->disabled()
                    ->live(),
                
                
                Grid::make(1)
                    ->schema(fn (Get $get): array => match ($get('type')) {
                        "0" => [
                            Repeater::make("expected_answer")
                            ->schema([
                                TextInput::make("proposition")
                                ->distinct(),
                                TextInput::make("correction"),
                                Toggle::make("vrai")
                                ->onColor("success")
                                ->offColor("danger")
                                ->inline(false),
                                
                            ])
                            ->live()
                            ->defaultItems(5)
                            ->minItems(4)
                            ->maxItems(20)
                            ->columns(3),

                            Toggle::make("proposed_count")
                    ],
                        "2" => [FileUpload::make("image"),],
                        "1" => [TextInput::make("expected_answer")],
                        
                    }),
                    
                    ToggleButtons::make('status')
                    ->options([
                        '0' => 'Brouillon',
                        '1' => 'En révisions',
                        '2' => 'Finie'
                    ])
                
                            ]);
    }
}
