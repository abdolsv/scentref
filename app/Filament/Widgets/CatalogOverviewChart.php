<?php

namespace App\Filament\Widgets;

use App\Models\Perfume;
use App\Models\Price;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CatalogOverviewChart extends ChartWidget
{
    // Fixed: Must be non-static instance properties
    protected ?string $heading = 'Data Ingestion Trends (6 Months)';

    protected ?string $maxHeight = '260px';
    
    protected int | string | array $columnSpan = '2';

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => Carbon::now()->subMonths($i)->format('M'));

        return [
            'datasets' => [
                [
                    'label' => 'Perfumes Indexed',
                    'data' => [12, 24, 35, 48, 65, Perfume::count()],
                    'borderColor' => '#C9A84C',
                    'backgroundColor' => 'rgba(201, 168, 76, 0.1)',
                    'fill' => 'start',
                ],
                [
                    'label' => 'Price Adjustments',
                    'data' => [45, 89, 120, 190, 240, Price::count()],
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'transparent',
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
