<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterPerfumesRequest;
use App\Models\SearchLog;
use App\Services\FilterService;
use Illuminate\Http\JsonResponse;

class FilterController extends Controller
{
    public function __construct(private FilterService $filterService) {}

    public function handle(FilterPerfumesRequest $request): JsonResponse
    {
        $perfumes = $this->filterService
            ->buildQuery($request->validated())
            ->paginate(24);

        // Log for trending analytics (no PII)
        if (!empty($request->validated()["q"])) {
            SearchLog::create([
                "query"         => substr($request->validated()["q"], 0, 200),
                "results_count" => $perfumes->total(),
                "ip_hash"       => hash("sha256", $request->ip()),
            ]);
        }

        return response()->json([
            "html"  => view("components.perfume-grid", compact("perfumes"))->render(),
            "total" => $perfumes->total(),
            "pages" => $perfumes->lastPage(),
            "page"  => $perfumes->currentPage(),
        ])->header("do-not-cache-response", "true");
    }
}

