<?php

namespace App\Filament\Student\Resources\Dossiers;

use App\Filament\Student\Resources\Dossiers\Pages\AnswerDossier;
use App\Filament\Student\Resources\Dossiers\Pages\ListDossiers;
use App\Filament\Student\Resources\Dossiers\Pages\ViewDossier;
use App\Filament\Student\Resources\Dossiers\Schemas\DossierForm;
use App\Filament\Student\Resources\Dossiers\Tables\DossiersTable;
use App\Models\Dossier;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DossierResource extends Resource
{
    protected static ?string $model = Dossier::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Dossiers';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return DossierForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DossiersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDossiers::route('/'),
            'answer' => AnswerDossier::route('/{record}/answer'),
            'view' => ViewDossier::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class])
            ->whereHas('questions', fn ($q) => $q->finalized());
    }
}
