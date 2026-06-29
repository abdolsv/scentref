<?php

namespace App\Filament\Resources\Prices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PriceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                Select::make('perfume_id')
                    ->relationship('perfume', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('vendor_id')
                    ->relationship('vendor', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('price_ngn')
                    ->label('Price (NGN)')
                    ->numeric()
                    ->prefix('₦')
                    ->required(),

                TextInput::make('shop_link')
                    ->label('Direct Product URL')
                    ->url()
                    ->placeholder('https://...'),
            ]),
        ]);
    }
}
