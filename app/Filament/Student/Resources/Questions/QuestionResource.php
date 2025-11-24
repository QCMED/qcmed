<?php

namespace App\Filament\Student\Resources\Questions;

use App\Filament\Student\Resources\Questions\Pages\AnswerQuestion;
use App\Filament\Student\Resources\Questions\Pages\CreateQuestion;
use App\Filament\Student\Resources\Questions\Pages\EditQuestion;
use App\Filament\Student\Resources\Questions\Pages\ListQuestions;
use App\Filament\Student\Resources\Questions\Pages\ViewQuestion;
use App\Filament\Student\Resources\Questions\Schemas\QuestionForm;
use App\Filament\Student\Resources\Questions\Tables\QuestionsTable;
use App\Models\Question;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'question';

    public static function form(Schema $schema): Schema
    {
        return QuestionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Informations')
                    ->schema([
                        \Filament\Schemas\Components\Text::make('info')
                            ->content(fn ($record) => "Item: " . ($record->chapter?->numero ?? '-') . " | Type: " . match(strval($record->type)) {
                                '0' => 'QCM/QRU/QRP',
                                '1' => 'QROC',
                                '2' => 'QZONE',
                                default => 'Inconnu'
                            }),
                    ]),
                
                \Filament\Schemas\Components\Section::make('Énoncé')
                    ->schema([
                        \Filament\Schemas\Components\Html::make(fn ($record) => $record->body),
                    ]),
                
                \Filament\Schemas\Components\Section::make('Correction')
                    ->schema([
                        \Filament\Schemas\Components\View::make('filament.forms.components.question-correction')
                            ->viewData(fn ($record) => [
                                'expected_answer' => $record->expected_answer,
                                'user_answer' => \App\Models\Attempt::where('question_id', $record->id)
                                    ->where('user_id', auth()->id())
                                    ->latest()
                                    ->first()?->answers ?? []
                            ]),
                    ])
                    ->visible(fn ($record) => strval($record->type) === '0'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return QuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuestions::route('/'),
            'answer' => AnswerQuestion::route('/{record}/answer'),
            'view' => ViewQuestion::route('/{record}'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
