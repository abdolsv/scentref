<?php

namespace App\Filament\Widgets;

use App\Models\Brand;
use App\Models\Note;
use App\Models\Perfume;
use App\Models\PriceAlert;
use App\Models\Vendor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DatabaseStatsWidget extends BaseWidget
{
    // Optional: Set polling interval if you want realtime counts (e.g., '15s', '30s', or null to disable)
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Perfumes', Perfume::count())
                ->description('Active catalog volume')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('primary'),

            Stat::make('Curated Brands', Brand::count())
                ->description('Fragrance houses onboarding')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),

            Stat::make('Active Vendors', Vendor::where('is_active', true)->count())
                ->description('Verified market sources')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),

            Stat::make('Live Price Alerts', PriceAlert::where('is_active', true)->count())
                ->description('Active user watches')
                ->descriptionIcon('heroicon-m-bell-alert')
                ->color('warning'),
        ];
    }
}
