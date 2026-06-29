<?php

namespace App\Filament\Resources\Vendors\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VendorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'marketplace' => 'success',
                        'dedicated'   => 'info',
                        'physical'    => 'warning',
                        'social'      => 'gray',
                        default       => 'gray',
                    }),
                
                TextColumn::make('prices_count')
                    ->counts('prices')
                    ->label('Price Entries')
                    ->sortable(),
                
                IconColumn::make('is_verified')
                    ->boolean()
                    ->label('Verified'),
                
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
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
