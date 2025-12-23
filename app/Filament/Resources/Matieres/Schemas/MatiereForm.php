<?php

namespace App\Filament\Resources\Matieres\Schemas;

use App\Filament\Resources\Chapters\Schemas\ChaptersForm;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MatiereForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                Textarea::make('description')
                    ->columnSpanFull(),

                
            ]);
    }
}
