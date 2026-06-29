<?php

namespace App\Http\Controllers;

use App\Models\{Perfume, Brand, ScentFamily};
use App\Services\{FilterService, SeoService};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PerfumeController extends Controller
{
    public function __construct(
        private FilterService $filterService,
        private SeoService $seoService,
    ) {}

    public function index(Request $request)
    {
        $page = $request->get("page", 1);
        $cacheKey = "perfumes.index.page.{$page}";

        $perfumes = Cache::get($cacheKey);

        // Self-heal index if serialization class maps are stale
        if (!($perfumes instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)) {
            Cache::forget($cacheKey);

            $perfumes = Perfume::query()
                ->with(["brand", "scentFamily", "currentPrices.vendor"])
                ->where("is_published", true)
                ->orderByDesc("pw_rating")
                ->paginate(24);

            Cache::put($cacheKey, $perfumes, 3600);
        }

        $brands        = Brand::where("is_active", true)->orderBy("name")->get();
        $scentFamilies = ScentFamily::where("is_active", true)->orderBy("sort_order")->get();

        return view("perfumes.index", compact("perfumes", "brands", "scentFamilies"));
    }

    public function show(string $slug)
    {
        $cacheKey = "perfume.show.{$slug}";

        // 1. Grab the cached object directly
        $perfume = Cache::get($cacheKey);

        // 2. SELF-HEAL: If the cache is an incomplete class instance or completely empty, fetch fresh
        if (!($perfume instanceof Perfume)) {
            Cache::forget($cacheKey); // Wipe the corrupted cache key immediately

            $perfume = Perfume::where("slug", $slug)
                ->where("is_published", true)
                ->with([
                    "brand", "scentFamily",
                    "topNotes", "heartNotes", "baseNotes",
                    "currentPrices.vendor", "approvedReviews",
                    "alternatives.brand", "alternatives.currentPrices.vendor",
                ])->firstOrFail();

            Cache::put($cacheKey, $perfume, 86400); // Store the full object graph safely
        }

        // 3. Properties and deep nested items are fully valid objects again
        $seo = $this->seoService->forPerfume($perfume);
        
        return view("perfumes.show", compact("perfume", "seo"));
    }

    public function men()   { return $this->genderArchive("men", "Men's Perfumes"); }
    public function women() { return $this->genderArchive("women", "Women's Perfumes"); }
    public function unisex(){ return $this->genderArchive("unisex", "Unisex Perfumes"); }

    private function genderArchive(string $gender, string $title)
    {
        $perfumes = Perfume::where("is_published", true)
            ->where("gender_target", $gender)
            ->with(["brand", "currentPrices.vendor"])
            ->orderByDesc("pw_rating")
            ->paginate(24);

        $brands        = Brand::where("is_active", true)->orderBy("name")->get();
        $scentFamilies = ScentFamily::where("is_active", true)->orderBy("sort_order")->get();

        return view("perfumes.index", [
            'perfumes'      => $perfumes,
            'brands'        => $brands,
            'scentFamilies' => $scentFamilies,
            'pageTitle'     => $title
        ]);
    }

    public function under5k()  { return $this->priceArchive(0, 5000, "Under ₦5,000"); }
    public function under10k() { return $this->priceArchive(0, 10000, "Under ₦10,000"); }
    public function under20k() { return $this->priceArchive(0, 20000, "Under ₦20,000"); }

    private function priceArchive(int $min, int $max, string $title)
    {
        $perfumes = Perfume::where("is_published", true)
            ->whereBetween("avg_price_ngn", [$min, $max])
            ->with(["brand", "currentPrices.vendor"])
            ->orderBy("avg_price_ngn")
            ->paginate(24);

        $brands        = Brand::where("is_active", true)->orderBy("name")->get();
        $scentFamilies = ScentFamily::where("is_active", true)->orderBy("sort_order")->get();

        return view("perfumes.index", [
            'perfumes'      => $perfumes,
            'brands'        => $brands,
            'scentFamilies' => $scentFamilies,
            'pageTitle'     => $title
        ]);
    }
}
