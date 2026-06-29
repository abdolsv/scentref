<?php

namespace App\Filament\Widgets;

use App\Models\Vendor;
use Filament\Tables\Actions\EditAction; // <-- Add this exact line if it's missing!
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class VendorAuditQueueWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Vendors Requiring Structural Verification';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Vendor::query()->where('is_verified', false)->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('name')
                    ->weight('bold'),
                
                TextColumn::make('type')
                    ->badge(),
                
                TextColumn::make('website_url')
                    ->label('Link Provided')
                    ->placeholder('None (Social/Physical Only)'),
                
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Discoverable'),
            ])
            ->actions([
                EditAction::make()
                    ->url(fn (Vendor $record) => url("admin/vendors/{$record->id}/edit")),
            ]);
    }
}
