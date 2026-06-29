<?php

namespace App\Filament\Resources\PriceAlerts\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PriceAlertsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('perfume.name')
                    ->searchable()
                    ->sortable()
                    ->limit(35),
                
                TextColumn::make('email')
                    ->searchable(),
                
                TextColumn::make('target_price_ngn')
                    ->label('Target ₦')
                    ->money('NGN')
                    ->sortable(),
                
                TextColumn::make('perfume.avg_price_ngn')
                    ->label('Current ₦')
                    ->money('NGN'),
                
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                
                TextColumn::make('last_notified_at')
                    ->dateTime()
                    ->label('Last Notified')
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->label('Created'),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Only'),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
