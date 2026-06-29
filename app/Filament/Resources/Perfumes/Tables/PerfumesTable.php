<?php

namespace App\Filament\Resources\Perfumes\Tables;

// Filament v4 unified action namespaces
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PerfumesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('brand.name')
                    ->searchable(),
                TextColumn::make('scentFamily.name')
                    ->searchable(),
                TextColumn::make('year_released')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('perfumer')
                    ->searchable(),
                TextColumn::make('gender_target')
                    ->searchable(),
                TextColumn::make('concentration')
                    ->searchable(),
                TextColumn::make('collection_line')
                    ->searchable(),
                TextColumn::make('longevity_heat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('longevity_ac')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('longevity_hours_avg')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sillage_rating')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('projection')
                    ->searchable(),
                TextColumn::make('availability')
                    ->searchable(),
                TextColumn::make('avg_price_ngn')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('last_price_updated')
                    ->date()
                    ->sortable(),
                TextColumn::make('import_difficulty')
                    ->searchable(),
                ImageColumn::make('bottle_image_path'),
                ImageColumn::make('box_image_path'),
                TextColumn::make('official_website_url')
                    ->searchable(),
                TextColumn::make('fragrantica_url')
                    ->searchable(),
                TextColumn::make('pw_rating')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('our_verdict')
                    ->searchable(),
                TextColumn::make('meta_title')
                    ->searchable(),
                TextColumn::make('meta_description')
                    ->searchable(),
                IconColumn::make('is_complete')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->boolean(),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
