<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Perfume;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    public function __construct(
        private SeoService $seo
    ) {}

    /**
     * Display all brands.
     */
    public function index()
    {
        /**
         * Cache only brand IDs.
         * Never cache Eloquent Collections.
         */
        $brandIds = Cache::remember(
            'brands.index.ids',
            now()->addHour(),
            function () {
                return Brand::query()
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->pluck('id')
                    ->toArray();
            }
        );

        $brands = Brand::query()
            ->whereIn('id', $brandIds)
            ->withCount([
                'perfumes as published_count' => function ($query) {
                    $query->where('is_published', true);
                }
            ])
            ->orderBy('name')
            ->get();

        return view('brands.index', compact('brands'));
    }

    /**
     * Display a single brand.
     */
    public function show(Request $request, string $slug)
    {
        /**
         * Cache only the brand ID.
         */
        $brandId = Cache::remember(
            "brand.slug.{$slug}",
            now()->addDay(),
            function () use ($slug) {
                return Brand::query()
                    ->where('slug', $slug)
                    ->where('is_active', true)
                    ->value('id');
            }
        );

        abort_if(!$brandId, 404);

        $brand = Brand::findOrFail($brandId);

        $page = (int) $request->input('page', 1);

        /**
         * Cache perfume IDs for each page.
         */
        $perfumeIds = Cache::remember(
            "brand.{$brand->id}.page.{$page}",
            now()->addHour(),
            function () use ($brand, $page) {

                return Perfume::query()
                    ->where('brand_id', $brand->id)
                    ->where('is_published', true)
                    ->orderByDesc('pw_rating')
                    ->forPage($page, 24)
                    ->pluck('id')
                    ->toArray();
            }
        );

        /**
         * Load perfumes normally.
         */
        $perfumes = Perfume::query()
            ->whereIn('id', $perfumeIds)
            ->with([
                'currentPrices.vendor'
            ])
            ->orderByDesc('pw_rating')
            ->paginate(
                24,
                ['*'],
                'page',
                $page
            );

        $seo = [
            'title' => "{$brand->name} Perfumes in Nigeria — Prices & Reviews",

            'description' =>
                "Browse all {$brand->name} fragrances available in Nigeria with current NGN prices, longevity ratings, and buyer reviews.",

            'canonical' => route(
                'brands.show',
                $brand->slug
            ),
        ];

        return view(
            'brands.show',
            compact(
                'brand',
                'perfumes',
                'seo'
            )
        );
    }

    /**
     * Clear all brand-related caches.
     * Call this after creating/updating/deleting a brand.
     */
    public static function clearCache(?Brand $brand = null): void
    {
        Cache::forget('brands.index.ids');

        if ($brand) {
            Cache::forget("brand.slug.{$brand->slug}");

            for ($page = 1; $page <= 100; $page++) {
                Cache::forget("brand.{$brand->id}.page.{$page}");
            }
        }
    }
}
