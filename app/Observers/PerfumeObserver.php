<?php

namespace App\Observers;

use App\Jobs\RegenerateSitemap;
use App\Models\Perfume;
use Spatie\ResponseCache\Facades\ResponseCache;

class PerfumeObserver
{
    public function updated(Perfume $perfume): void
    {
        if ($perfume->wasChanged("is_published") && $perfume->is_published) {
            RegenerateSitemap::dispatch()->onQueue("default");
        }

        ResponseCache::forget("/perfume/{$perfume->slug}");
    }
}

