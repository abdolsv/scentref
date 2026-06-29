<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),
                    
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                    
                Select::make('tier')
                    ->options([
                        'luxury'               => 'Luxury',
                        'designer'             => 'Designer',
                        'niche'                => 'Niche',
                        'accessible_designer'  => 'Accessible Designer',
                        'budget'               => 'Budget',
                        'arabian'              => 'Arabian / Middle Eastern',
                    ])
                    ->required(),
                    
                TextInput::make('origin_country')
                    ->placeholder('France, UAE, USA…'),
                    
                TextInput::make('website_url')
                    ->url(),
                    
                FileUpload::make('logo_path')
                    ->image()
                    ->disk('s3')
                    ->directory('brands/logos')
                    ->imageResizeTargetWidth(200)
                    ->imageResizeTargetHeight(200)
                    ->columnSpanFull(),
                    
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
                    
                Textarea::make('nigeria_availability_note')
                    ->label('Nigeria Availability Note')
                    ->rows(2)
                    ->columnSpanFull()
                    ->helperText('E.g. "Widely available on Jumia and Konga. Popular at Trade Fair."'),
                    
                Textarea::make('editor_note')
                    ->label('Editor\'s Note')
                    ->rows(2)
                    ->columnSpanFull()
                    ->helperText('Internal editorial note displayed on the brand page.'),
                    
                Toggle::make('is_featured')
                    ->label('Featured on Homepage')
                    ->required(),
                    
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
            ]);
    }
}
