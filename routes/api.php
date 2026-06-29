<?php
// routes/api.php
use App\Http\Controllers\Api\V1\{BrandApiController, PerfumeApiController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ScentRef Public API — v1
| All routes are public (read-only). No auth required.
| Rate-limited to 120 req/min by default (throttle:api middleware).
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->middleware(['throttle:api'])->group(function () {

    // ── Perfumes ─────────────────────────────────────────────────────
    Route::get('/perfumes',        [PerfumeApiController::class, 'index']);
    Route::get('/perfumes/{slug}', [PerfumeApiController::class, 'show']);

    // ── Brands ───────────────────────────────────────────────────────
    Route::get('/brands',          [BrandApiController::class, 'index']);
    Route::get('/brands/{slug}',   [BrandApiController::class, 'show']);

    // ── API meta ─────────────────────────────────────────────────────
    Route::get('/', fn() => response()->json([
        'api'       => 'ScentRef.ng Public API',
        'version'   => 'v1',
        'endpoints' => [
            'GET /api/v1/perfumes'        => 'Browse perfumes (filterable)',
            'GET /api/v1/perfumes/{slug}' => 'Single perfume detail',
            'GET /api/v1/brands'          => 'Brand directory',
            'GET /api/v1/brands/{slug}'   => 'Brand detail + perfume listing',
        ],
        'docs'       => 'https://scentref.ng/api/v1',
        'rate_limit' => '120 requests/minute',
    ]));
});
