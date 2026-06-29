<?php

namespace App\Providers;

use App\Models\Perfume;
use App\Models\Price;
use App\Observers\PerfumeObserver;
use App\Observers\PriceObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Price::observe(PriceObserver::class);
        Perfume::observe(PerfumeObserver::class);

        $this->app->singleton(\App\Services\SeoService::class);
        $this->app->singleton(\App\Services\FilterService::class);
        $this->app->singleton(\App\Services\PriceService::class);
        $this->app->singleton(\App\Services\ReviewService::class);
    }
}
