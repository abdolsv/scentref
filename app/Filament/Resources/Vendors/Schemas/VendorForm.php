<?php

namespace App\Filament\Resources\Vendors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class VendorForm
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
                
                Select::make('type')
                    ->options([
                        'marketplace' => 'Marketplace (Jumia, Konga)',
                        'dedicated'   => 'Dedicated Perfume Store',
                        'physical'    => 'Physical Store / Market',
                        'social'      => 'Social Media / WhatsApp',
                    ])
                    ->required(),
                
                TextInput::make('website_url')
                    ->url()
                    ->label('Website URL'),
                
                TextInput::make('affiliate_param')
                    ->label('Affiliate Param Key')
                    ->helperText('e.g. "aff_id" for Jumia'),
                
                TextInput::make('affiliate_value')
                    ->label('Affiliate Param Value')
                    ->helperText('Your affiliate ID or ref code'),
                
                Textarea::make('notes')
                    ->rows(2)
                    ->columnSpanFull()
                    ->helperText('Internal notes about this vendor'),
                
                Toggle::make('is_active')
                    ->default(true),
                
                Toggle::make('is_verified')
                    ->label('Verified Vendor'),
            ]),
        ]);
    }
}
