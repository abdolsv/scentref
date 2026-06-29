<?php

namespace App\Filament\Resources\Prices\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PriceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('perfume.name')
                    ->label('Perfume'),
                TextEntry::make('vendor.name')
                    ->label('Vendor'),
                TextEntry::make('price_ngn')
                    ->numeric(),
                IconEntry::make('is_verified')
                    ->boolean(),
                TextEntry::make('verified_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('source_url')
                    ->placeholder('-'),
                IconEntry::make('is_current')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
