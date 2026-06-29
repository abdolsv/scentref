<?php

namespace App\Filament\Resources\Perfumes;

use App\Filament\Resources\Perfumes\Pages\CreatePerfume;
use App\Filament\Resources\Perfumes\Pages\EditPerfume;
use App\Filament\Resources\Perfumes\Pages\ListPerfumes;
use App\Filament\Resources\Perfumes\Pages\ViewPerfume;
use App\Filament\Resources\Perfumes\Schemas\PerfumeForm;
use App\Filament\Resources\Perfumes\Schemas\PerfumeInfolist;
use App\Filament\Resources\Perfumes\Tables\PerfumesTable;
use App\Models\Perfume;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerfumeResource extends Resource
{
    // Strict typing adjustments for Filament v4 Core
    protected static ?string $model = Perfume::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Perfume Database';

    protected static ?int $navigationSort = 1;

    /**
     * Handled by App\Filament\Resources\Perfumes\Schemas\PerfumeForm
     */
    public static function form(Schema $schema): Schema
    {
        return PerfumeForm::configure($schema);
    }

    /**
     * Handled by App\Filament\Resources\Perfumes\Schemas\PerfumeInfolist
     */
    public static function infolist(Schema $schema): Schema
    {
        return PerfumeInfolist::configure($schema);
    }

    /**
     * Handled by App\Filament\Resources\Perfumes\Tables\PerfumesTable
     */
    public static function table(Table $table): Table
    {
        return PerfumesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            // Add RelationManagers here as your schema scales
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPerfumes::route('/'),
            'create' => CreatePerfume::route('/create'),
            'view'   => ViewPerfume::route('/{record}'),
            'edit'   => EditPerfume::route('/{record}/edit'),
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
