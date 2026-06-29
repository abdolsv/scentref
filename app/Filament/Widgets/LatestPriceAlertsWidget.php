<?php

namespace App\Filament\Widgets;

use App\Models\PriceAlert;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPriceAlertsWidget extends BaseWidget
{
    // Extends across the screen or stacks beautifully on mobile Termux sessions
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Recent Price Alerts & User Targets';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PriceAlert::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('perfume.name')
                    ->label('Perfume Catalog Item')
                    ->weight('semibold')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Subscriber'),

                TextColumn::make('target_price_ngn')
                    ->label('Target Price')
                    ->money('NGN'),

                TextColumn::make('perfume.avg_price_ngn')
                    ->label('Current Average')
                    ->money('NGN'),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Logged')
                    ->dateTime('M d, g:i A'),
            ]);
    }
}
