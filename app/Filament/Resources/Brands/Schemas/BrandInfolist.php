<?php

namespace App\Filament\Resources\Brands\Schemas;

use App\Models\Brand;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
// Filament v4 Unified Layout Namespace
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BrandInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->schema([
                
                // MAIN COLUMN (Spans 2 out of 3 columns)
                Group::make([
                    
                    // SECTION 1: IDENTITY & MARKET POSITION
                    Section::make('Brand Profile')
                        ->description('Core profile parameters and global house origin details')
                        ->icon('heroicon-o-building-office')
                        ->schema([
                            Grid::make(2)->schema([
                                TextEntry::make('name')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->size('lg'),

                                TextEntry::make('slug')
                                    ->icon('heroicon-o-link'),

                                TextEntry::make('origin_country')
                                    ->label('Country of Origin')
                                    ->icon('heroicon-o-globe-alt')
                                    ->placeholder('-'),

                                TextEntry::make('tier')
                                    ->label('Brand Positioning')
                                    ->badge()
                                    ->color(fn (string $state): string => match (strtolower($state)) {
                                        'luxury', 'niche' => 'warning',
                                        'designer' => 'primary',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                            ]),

                            TextEntry::make('description')
                                ->label('House Biography')
                                ->markdown()
                                ->placeholder('No house biography recorded yet.')
                                ->columnSpanFull(),
                        ]),

                    // SECTION 2: REGIONAL LOGISTICS & MANAGEMENT
                    Section::make('Editorial & Local Market Insights')
                        ->description('Local distribution footprints curated specifically for the Nigerian landscape')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            TextEntry::make('nigeria_availability_note')
                                ->label('Nigerian Availability Footprint')
                                ->placeholder('No availability or local retail footprints documented.')
                                ->columnSpanFull(),

                            TextEntry::make('editor_note')
                                ->label('ScentRef Curated Editorial Review')
                                ->placeholder('Pending editorial oversight notes.')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(2),

                // SIDEBAR COLUMN (Spans 1 out of 3 columns)
                Group::make([
                    
                    // SIDEBAR SECTION 1: PRESENTATION
                    Section::make('Identity Assets')
                        ->schema([
                            ImageEntry::make('logo_path')
                                ->label('Official House Crest / Logo')
                                ->disk('s3')
                                ->height(100)
                                ->placeholder('No visual logo available'),

                            TextEntry::make('website_url')
                                ->label('Global Digital Portal')
                                ->icon('heroicon-o-arrow-top-right-on-square')
                                ->color('primary')
                                ->url(fn (?string $state): ?string => $state, shouldOpenInNewTab: true)
                                ->placeholder('-'),
                        ]),

                    // SIDEBAR SECTION 2: LIVE MATRIX & TIMESTAMPS
                    Section::make('Operational Status')
                        ->schema([
                            Grid::make(2)->schema([
                                IconEntry::make('is_active')
                                    ->label('Operational')
                                    ->boolean(),

                                IconEntry::make('is_featured')
                                    ->label('Featured House')
                                    ->boolean(),
                            ]),

                            TextEntry::make('created_at')
                                ->label('Registered')
                                ->dateTime('M d, Y H:i')
                                ->size('sm')
                                ->color('gray'),

                            TextEntry::make('updated_at')
                                ->label('Last Audit')
                                ->dateTime('M d, Y H:i')
                                ->size('sm')
                                ->color('gray'),

                            TextEntry::make('deleted_at')
                                ->label('Date Archived')
                                ->dateTime('M d, Y H:i')
                                ->color('danger')
                                ->visible(fn (Brand $record): bool => $record->trashed()),
                        ]),
                ])->columnSpan(1),

            ])->columnSpanFull()
        ]);
    }
}
