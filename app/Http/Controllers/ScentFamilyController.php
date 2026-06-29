<?php

namespace App\Http\Controllers;

use App\Models\ScentFamily;
use App\Models\Perfume;
use App\Services\SeoService;
use Illuminate\View\View;

class ScentFamilyController extends Controller
{
    /**
     * Display perfumes associated with a designated scent family.
     */
    public function show(string $slug): View
    {
        $family = ScentFamily::where('slug', $slug)->firstOrFail();

        $perfumes = Perfume::where('is_published', true)
            ->where('scent_family_id', $family->id)
            ->with(['brand', 'currentPrices.vendor'])
            ->orderByDesc('pw_rating')
            ->paginate(24);

        $seo = app(SeoService::class)->forScentFamily($family, $perfumes->total());

        return view('scent-families.show', compact('family', 'perfumes', 'seo'));
    }
}
