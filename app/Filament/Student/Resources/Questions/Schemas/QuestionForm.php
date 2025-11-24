<?php

namespace App\Filament\Student\Resources\Questions\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de la question')
                    ->schema([
                        Placeholder::make('chapter_info')
                            ->label('Chapitre')
                            ->content(fn ($record) => $record->chapter ? "Item {$record->chapter->numero}" : '-'),
                        
                        Placeholder::make('type_info')
                            ->label('Type')
                            ->content(fn ($record) => match(strval($record->type)) {
                                '0' => 'QCM/QRU/QRP',
                                '1' => 'QROC',
                                '2' => 'QZONE',
                                default => 'Inconnu'
                            }),
                    ])->columns(2),
                
                Section::make('Énoncé')
                    ->schema([
                        ViewField::make('body')
                            ->label('')
                            ->view('filament.forms.components.html-content'),
                    ]),
                
                Section::make('Propositions de réponse')
                    ->schema([
                        ViewField::make('expected_answer')
                            ->label('')
                            ->view('filament.forms.components.question-answers')
                            ->visible(fn ($record) => strval($record->type) === '0'),
                    ])
                    ->visible(fn ($record) => strval($record->type) === '0'),
            ]);
    }
}

