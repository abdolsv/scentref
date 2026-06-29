<?php

namespace App\Http\Controllers;

use App\Models\{Brand, Note, Perfume, ScentFamily};
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Cache only raw arrays (100% immune to serialization / incomplete object errors)
        $featuredData = Cache::remember('home.featured', 3600, fn() =>
            Perfume::where('is_published', true)
                ->where('our_verdict', 'must_buy')
                ->with(['brand', 'currentPrices.vendor'])
                ->orderByDesc('pw_rating')
                ->limit(8)
                ->get()
                ->toArray()
        );

        $topRatedData = Cache::remember('home.top_rated', 3600, fn() =>
            Perfume::where('is_published', true)
                ->with(['brand', 'currentPrices.vendor'])
                ->orderByDesc('pw_rating')
                ->limit(8)
                ->get()
                ->toArray()
        );

        $budgetData = Cache::remember('home.budget', 3600, fn() =>
            Perfume::where('is_published', true)
                ->where('avg_price_ngn', '<=', 5000)
                ->with(['brand', 'currentPrices.vendor'])
                ->orderBy('avg_price_ngn')
                ->limit(8)
                ->get()
                ->toArray()
        );

        $brandsData = Cache::remember('home.brands', 43200, fn() =>
            Brand::where('is_active', true)
                ->where('is_featured', true)
                ->withCount(['perfumes as published_count' => fn($q) => $q->where('is_published', true)])
                ->orderByDesc('published_count')
                ->limit(12)
                ->get()
                ->toArray()
        );

        $scentFamiliesData = Cache::remember('home.scent_families', 43200, fn() =>
            ScentFamily::where('is_active', true)
                ->withCount(['perfumes as published_count' => fn($q) => $q->where('is_published', true)])
                ->orderBy('sort_order')
                ->limit(12)
                ->get()
                ->toArray()
        );

        $stats = Cache::remember('home.stats', 3600, fn() => [
            'perfumes' => Perfume::where('is_published', true)->count(),
            'brands'   => Brand::where('is_active', true)->count(),
            'notes'    => Note::count(),
        ]);

        // 2. Safely transform data arrays into collections of objects using hydration helpers
        $featured = $this->hydrate($featuredData);
        $topRated = $this->hydrate($topRatedData);
        $budget    = $this->hydrate($budgetData);
        $brands    = $this->hydrate($brandsData);
        $scentFamilies = $this->hydrate($scentFamiliesData);

        return view('home', compact(
            'featured', 'topRated', 'budget', 'brands', 'scentFamilies', 'stats'
        ));
    }

    /**
     * Helper to safely decode arrays into cleanly structured objects for Blade components
     */
    private function hydrate(array $data)
    {
        return collect(json_decode(json_encode($data), false));
    }
}
