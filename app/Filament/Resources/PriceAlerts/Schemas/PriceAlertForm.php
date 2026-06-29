<?php

namespace App\Filament\Resources\PriceAlerts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PriceAlertForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                Select::make('perfume_id')
                    ->relationship('perfume', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
                
                TextInput::make('email')
                    ->email()
                    ->required(),
                
                TextInput::make('target_price_ngn')
                    ->label('Target Price (₦)')
                    ->numeric()
                    ->prefix('₦')
                    ->required(),
                
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]),
        ]);
    }
}
