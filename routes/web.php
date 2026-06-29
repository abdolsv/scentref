<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController, PerfumeController, BrandController,
    NoteController, ScentFamilyController, ReviewController,
    FilterController, PriceAlertController, SitemapController
};

// ── Homepage ──────────────────────────────────────────────────────────
Route::get("/", [HomeController::class, "index"])->name("home");

// ── Perfume Database ──────────────────────────────────────────────────
Route::get("/perfume", [PerfumeController::class, "index"])
    ->middleware("cache.control:3600")->name("perfumes.index");
Route::get("/perfume/{slug}", [PerfumeController::class, "show"])
    ->middleware("cache.control:86400")->name("perfumes.show");

// ── Filter AJAX ───────────────────────────────────────────────────────
Route::post("/perfume/filter", [FilterController::class, "handle"])
    ->name("perfumes.filter");

// ── Gender Archives ───────────────────────────────────────────────────
Route::get("/perfume-for-men", [PerfumeController::class, "men"])->name("perfumes.men");
Route::get("/perfume-for-women", [PerfumeController::class, "women"])->name("perfumes.women");
Route::get("/unisex-perfume", [PerfumeController::class, "unisex"])->name("perfumes.unisex");

// ── Price Range Pages ─────────────────────────────────────────────────
Route::get("/perfume-under-5000", [PerfumeController::class, "under5k"])->name("perfumes.under5k");
Route::get("/perfume-under-10000", [PerfumeController::class, "under10k"])->name("perfumes.under10k");
Route::get("/perfume-under-20000", [PerfumeController::class, "under20k"])->name("perfumes.under20k");

// ── Brand Archives ────────────────────────────────────────────────────
Route::get("/brand", [BrandController::class, "index"])->name("brands.index");
Route::get("/brand/{slug}", [BrandController::class, "show"])->name("brands.show");

// ── Scent Family & Note Archives ──────────────────────────────────────
Route::get("/scent/{slug}", [ScentFamilyController::class, "show"])->name("scent-families.show");
Route::get("/note/{slug}", [NoteController::class, "show"])->name("notes.show");

// ── Reviews ───────────────────────────────────────────────────────────
Route::post("/perfume/{slug}/reviews", [ReviewController::class, "store"])
    ->name("reviews.store")
    ->middleware("throttle:3,1440");
Route::get("/review/verify/{token}", [ReviewController::class, "verify"])
    ->name("reviews.verify");

// ── Price Alerts ──────────────────────────────────────────────────────
Route::post("/price-alert", [PriceAlertController::class, "store"])
    ->name("price-alerts.store")
    ->middleware("throttle:5,60");
Route::get("/price-alert/unsubscribe/{token}", [PriceAlertController::class, "unsubscribe"])
    ->name("price-alerts.unsubscribe");

// ── Sitemaps ──────────────────────────────────────────────────────────
Route::get("/sitemap.xml", [SitemapController::class, "index"]);
Route::get("/sitemap-perfumes.xml", [SitemapController::class, "perfumes"]);
Route::get("/sitemap-brands.xml", [SitemapController::class, "brands"]);
Route::get("/sitemap-notes.xml", [SitemapController::class, "notes"]);

// ── Static Pages ──────────────────────────────────────────────────────
Route::get("/about", fn() => view("about"))->name("about");
Route::get("/contact", fn() => view("contact"))->name("contact");

