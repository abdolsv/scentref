<?php

namespace App\Filament\Resources\Brands\Tables;

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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_path')
                    ->disk('s3')
                    ->height(36)
                    ->width(36)
                    ->label('Logo'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tier')
                    ->badge()
                    ->color(fn($state) => match($state) {
                        'luxury'               => 'warning',
                        'niche'                => 'info',
                        'designer'             => 'primary',
                        'accessible_designer'  => 'success',
                        'arabian'              => 'warning',
                        default                => 'gray',
                    }),

                TextColumn::make('origin_country')
                    ->label('Country'),

                TextColumn::make('published_perfumes_count')
                    ->counts('publishedPerfumes')
                    ->label('Live Perfumes')
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

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
                SelectFilter::make('tier')->options([
                    'luxury' => 'Luxury', 
                    'designer' => 'Designer',
                    'niche' => 'Niche', 
                    'accessible_designer' => 'Accessible Designer',
                    'budget' => 'Budget', 
                    'arabian' => 'Arabian',
                ]),
                TernaryFilter::make('is_featured')->label('Featured'),
                TernaryFilter::make('is_active')->label('Active'),
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
            ])
            ->defaultSort('name');
    }
}

