<?php

namespace App\Filament\Resources\Perfumes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
// Unified Layout components for Filament v4
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PerfumeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->schema([
                
                // MAIN CONTENT COLUMN (Spans 2 out of 3 columns)
                Group::make([
                    
                    // SECTION 1: THE SCENT IDENTITY
                    Section::make('Scent Profile')
                        ->description('Core olfactory identity and presentation details')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Grid::make(3)->schema([
                                TextEntry::make('name')
                                    ->weight('bold')
                                    ->size('lg')
                                    ->color('primary'),
                                
                                TextEntry::make('brand.name')
                                    ->weight('semibold')
                                    ->icon('heroicon-o-building-office'),
                                
                                TextEntry::make('concentration')
                                    ->badge()
                                    ->color('warning')
                                    ->formatStateUsing(fn (string $state): string => strtoupper($state)),
                                
                                TextEntry::make('scentFamily.name')
                                    ->icon('heroicon-o-tag'),
                                
                                TextEntry::make('gender_target')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'men' => 'info',
                                        'women' => 'danger',
                                        default => 'success',
                                    })
                                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                                TextEntry::make('year_released')
                                    ->icon('heroicon-o-calendar'),
                            ]),

                            TextEntry::make('official_description')
                                ->markdown()
                                ->columnSpanFull(),
                        ]),

                    // SECTION 2: OLFACTORY PYRAMID
                    Section::make('The Olfactory Pyramid')
                        ->description('Note transitions from initial spray to deep drydown')
                        ->icon('heroicon-o-sparkles')
                        ->schema([
                            TextEntry::make('topNotes.name')
                                ->label('Top Notes (Opening)')
                                ->badge()
                                ->color('success')
                                ->columnSpanFull(),

                            TextEntry::make('heartNotes.name')
                                ->label('Heart Notes (Mid)')
                                ->badge()
                                ->color('primary')
                                ->columnSpanFull(),

                            TextEntry::make('baseNotes.name')
                                ->label('Base Notes (Drydown)')
                                ->badge()
                                ->color('gray')
                                ->columnSpanFull(),

                            Grid::make(2)->schema([
                                TextEntry::make('opening_character')
                                    ->helperText('Initial impressions upon spraying'),
                                TextEntry::make('drydown_character')
                                    ->helperText('How it settles after hours'),
                            ]),
                        ]),

                    // SECTION 3: PERFORMANCE BENCHMARKS
                    Section::make('Real-World Performance')
                        ->description('Evaluated metrics engineered for local climate profiles')
                        ->icon('heroicon-o-bolt')
                        ->schema([
                            Grid::make(4)->schema([
                                TextEntry::make('longevity_heat')
                                    ->label('Lagos Heat Durability')
                                    ->numeric()
                                    ->suffix('/10')
                                    ->weight('bold'),

                                TextEntry::make('longevity_ac')
                                    ->label('AC Environment Durability')
                                    ->numeric()
                                    ->suffix('/10')
                                    ->weight('bold'),

                                TextEntry::make('longevity_hours_avg')
                                    ->label('Average Runtime')
                                    ->suffix(' hours')
                                    ->weight('bold'),

                                TextEntry::make('sillage_rating')
                                    ->label('Sillage (Trail)')
                                    ->suffix('/10')
                                    ->weight('bold'),
                            ]),

                            Grid::make(2)->schema([
                                TextEntry::make('best_season_nigeria')
                                    ->label('Ideal Local Seasons')
                                    ->badge()
                                    ->color('info'),

                                TextEntry::make('best_occasion')
                                    ->label('Recommended Occasions')
                                    ->badge()
                                    ->color('success'),
                            ]),
                        ]),
                ])->columnSpan(2),

                // SIDEBAR COLUMN (Spans 1 out of 3 columns)
                Group::make([
                    
                    // SIDEBAR SECTION 1: IMAGES
                    Section::make('Visual Presentation')
                        ->schema([
                            ImageEntry::make('bottle_image_path')
                                ->label('Bottle Presentation')
                                ->disk('s3')
                                ->height(180)
                                ->square(),

                            ImageEntry::make('box_image_path')
                                ->label('Retail Box')
                                ->disk('s3')
                                ->height(120)
                                ->square(),
                        ]),

                    // SIDEBAR SECTION 2: LOGISTICS & EDITORIAL
                    Section::make('Market Status')
                        ->schema([
                            TextEntry::make('avg_price_ngn')
                                ->label('Est. Retail Price')
                                ->money('NGN')
                                ->weight('black')
                                ->size('lg')
                                ->color('success'),

                            TextEntry::make('availability')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'available' => 'success',
                                    'import_only' => 'warning',
                                    default => 'danger',
                                }),

                            TextEntry::make('our_verdict')
                                ->label('ScentRef Verdict')
                                ->badge()
                                ->color('primary')
                                ->weight('bold'),

                            TextEntry::make('pw_rating')
                                ->label('Our Rating')
                                ->suffix(' / 10')
                                ->weight('bold'),
                                
                            IconEntry::make('is_published')
                                ->label('Live Status')
                                ->boolean(),
                        ]),
                ])->columnSpan(1),

            ])->columnSpanFull()
        ]);
    }
}
