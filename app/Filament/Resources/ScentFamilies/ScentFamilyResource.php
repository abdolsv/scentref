<?php

namespace App\Filament\Resources\ScentFamilies;

use App\Filament\Resources\ScentFamilies\Pages;
use App\Filament\Resources\ScentFamilies\Schemas\ScentFamilyForm;
use App\Filament\Resources\ScentFamilies\Tables\ScentFamiliesTable;
use App\Models\ScentFamily;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ScentFamilyResource extends Resource
{
    protected static ?string $model = ScentFamily::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string|UnitEnum|null $navigationGroup = 'Perfume Database';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ScentFamilyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ScentFamiliesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListScentFamilies::route('/'),
            'create' => Pages\CreateScentFamily::route('/create'),
            'edit'   => Pages\EditScentFamily::route('/{record}/edit'),
        ];
    }
}
