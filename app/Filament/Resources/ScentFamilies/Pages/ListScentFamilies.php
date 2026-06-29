<?php

namespace App\Filament\Resources\ScentFamilies\Pages;

use App\Filament\Resources\ScentFamilies\ScentFamilyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListScentFamilies extends ListRecords
{
    protected static string $resource = ScentFamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
