<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Models\Chapter;
use App\Models\LearningObjective;
use Closure;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function schemaArray(): array
    {
        return [
            Select::make('chapter_id')
                ->label('Chapitre')
                ->options(function () {
                    return Chapter::query()
                        ->get()
                        ->mapWithKeys(fn ($chapter) => [
                            $chapter->id => "Item {$chapter->numero} - ".\Illuminate\Support\Str::limit($chapter->description, 80),
                        ]);
                })
                ->searchable()
                ->loadingMessage('Chargement des chapitres...')
                ->noSearchResultsMessage('Pas de chapitre trouvé.')
                ->optionsLimit(10)
                ->required()
                ->live()
                ->afterStateUpdated(fn (callable $set) => $set('learningObjectives', []))
                ->columnSpan(3),

            Select::make('type')
                ->label('Type de question')
                ->options([
                    '0' => 'QCM/QRU/QRP',
                    // "1" => "QROC",
                    // "2" => "QZONE",
                ])
                ->default('0')
                ->required()
                ->columnSpan(1)
                ->live(),

            ToggleButtons::make('status')
                ->options([
                    '0' => 'Brouillon',
                    '1' => 'En révisions',
                    '2' => 'Finie',
                ])
                ->grouped()
                ->required()
                ->columnSpan(2),

            Select::make('learningObjectives')
                ->label("Objectifs d'apprentissage")
                ->multiple()
                ->relationship('learningObjectives', 'intitule')
                ->options(function (callable $get) {
                    $chapterId = $get('chapter_id');
                    if (! $chapterId) {
                        return [];
                    }

                    $chapter = Chapter::find($chapterId);
                    if (! $chapter) {
                        return [];
                    }

                    return LearningObjective::where('chapter_numero', $chapter->numero)
                        ->get()
                        ->mapWithKeys(fn ($objective) => [
                            $objective->id => "[{$objective->rang}] {$objective->rubrique} - ".\Illuminate\Support\Str::limit($objective->intitule, 100),
                        ]);
                })
                ->searchable()
                ->preload()
                ->columnSpanFull()
                ->helperText('Sélectionnez un ou plusieurs objectifs d\'apprentissage associés à cette question')
                ->maxItems(5),

            MarkdownEditor::make('body')
                ->label('Énoncé de la question')
                ->columnSpanFull()
                ->required(),

            Grid::make(1)
                ->schema(fn (Get $get): array => match (strval($get('type'))) {
                    '0' => [
                        Toggle::make('proposed_count')
                            ->columnSpanFull()
                            ->label("Afficher le nombre de propositions à cocher pour l'étudiant ")
                            ->helperText('Transforme le QCM en un QRU ou QRP court ou long'),

                        Repeater::make('expected_answer')
                            ->schema([
                                TextInput::make('proposition')
                                    ->distinct()
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('correction')
                                    ->columnSpan(5),
                                Toggle::make('vrai')
                                    ->onColor('success')
                                    ->label('vrai ou faux?')
                                    ->offColor('danger')
                                    ->inline(false),
                            ])
                            ->rules([
                                fn (): Closure => function (string $attribute, $value, Closure $fail) {
                                    $atLeastOneCorrectAnswer = false;
                                    foreach ($value as $item) {
                                        if ($item['vrai'] == true) {
                                            $atLeastOneCorrectAnswer = true;
                                        }
                                    }
                                    if ($atLeastOneCorrectAnswer === false) {

                                        $fail('Il faut mettre au moins une réponse vraie!');
                                    }
                                },
                            ])
                            ->live()
                            ->defaultItems(5)
                            ->minItems(4)
                            ->maxItems(20)
                            ->columns(6)
                            ->addActionLabel('Ajouter une proposition')
                            ->columnSpanFull(),
                    ],
                    // "1" => [TextInput::make("expected_answer")],
                    // "2" => [FileUpload::make("image"),],
                    default => []

                })
                ->columnSpanFull()
                ->columns(6),

        ];
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(6)
            ->components(self::schemaArray());
    }
}
