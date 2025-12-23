<?php

namespace App\Filament\Resources\Matieres\Pages;

use App\Filament\Resources\Matieres\MatiereResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMatieres extends ListRecords
{
    protected static string $resource = MatiereResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
