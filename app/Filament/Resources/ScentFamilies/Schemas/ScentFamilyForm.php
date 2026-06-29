<?php

namespace App\Filament\Resources\ScentFamilies\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ScentFamilyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('name')
                    ->required(),
                
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                
                TextInput::make('icon')
                    ->label('Emoji Icon')
                    ->placeholder('🌸'),
                
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
                
                Toggle::make('is_active')
                    ->default(true),
            ]),
        ]);
    }
}
