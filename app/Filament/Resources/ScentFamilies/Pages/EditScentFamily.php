<?php

namespace App\Filament\Resources\ScentFamilies\Pages;

use App\Filament\Resources\ScentFamilies\ScentFamilyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditScentFamily extends EditRecord
{
    protected static string $resource = ScentFamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
