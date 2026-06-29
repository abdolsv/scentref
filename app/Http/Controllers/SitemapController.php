<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Note;
use App\Models\Perfume;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Display the index sitemap index shell.
     */
    public function index(): Response
    {
        return response()
            ->view('sitemap.index')
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Stream dynamic contextual sitemap profiles for published items.
     */
    public function perfumes(): Response
    {
        $perfumes = Cache::remember('sitemap-perfumes', 21600, function () {
            return Perfume::where('is_published', true)
                ->select('slug', 'updated_at')
                ->orderByDesc('updated_at')
                ->get();
        });

        return response()
            ->view('sitemap.perfumes', compact('perfumes'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Stream sitemap entries detailing brand profiles.
     */
    public function brands(): Response
    {
        $brands = Cache::remember('sitemap-brands', 21600, function () {
            return Brand::where('is_active', true)
                ->select('slug', 'updated_at')
                ->get();
        });

        return response()
            ->view('sitemap.brands', compact('brands'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Stream structured vocabulary reference collections.
     */
    public function notes(): Response
    {
        $notes = Cache::remember('sitemap-notes', 21600, function () {
            return Note::select('slug', 'updated_at')->get();
        });

        return response()
            ->view('sitemap.notes', compact('notes'))
            ->header('Content-Type', 'application/xml');
    }
}
