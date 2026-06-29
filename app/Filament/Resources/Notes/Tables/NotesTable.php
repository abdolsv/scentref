<?php

namespace App\Filament\Resources\Notes\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('family')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'citrus' => 'warning',
                        'floral' => 'danger',
                        'woody' => 'primary',
                        'aquatic' => 'info',
                        default => 'gray',
                    }),
                
                TextColumn::make('parent.name')
                    ->label('Parent')
                    ->sortable(),
                
                TextColumn::make('children_count')
                    ->counts('children')
                    ->label('Children'),
            ])
            ->filters([
                SelectFilter::make('family')
                    ->options([
                        'citrus'   => 'Citrus', 
                        'floral'   => 'Floral',
                        'woody'    => 'Woody', 
                        'spicy'    => 'Spicy',
                        'musky'    => 'Musky', 
                        'gourmand' => 'Gourmand',
                        'aquatic'  => 'Aquatic', 
                        'resinous' => 'Resinous',
                    ]),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('name');
    }
}
