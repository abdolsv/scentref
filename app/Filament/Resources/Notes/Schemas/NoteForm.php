<?php

namespace App\Filament\Resources\Notes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class NoteForm
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
                
                Select::make('parent_id')
                    ->label('Parent Note')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText('E.g. Bergamot → parent is Citrus'),
                
                Select::make('family')
                    ->options([
                        'citrus'    => 'Citrus',   
                        'floral'    => 'Floral',
                        'woody'     => 'Woody',    
                        'spicy'     => 'Spicy',
                        'musky'     => 'Musky',    
                        'gourmand'  => 'Gourmand',
                        'aquatic'   => 'Aquatic',  
                        'resinous'  => 'Resinous',
                        'earthy'    => 'Earthy',
                    ]),
                
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
            ]),
        ]);
    }
}
