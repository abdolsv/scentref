<?php

namespace App\Filament\Resources\Prices\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PricesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('perfume.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('vendor.name')
                    ->sortable(),

                TextColumn::make('price_ngn')
                    ->label('Price')
                    ->money('NGN')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Checked')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('vendor')
                    ->relationship('vendor', 'name'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
