<?php // This file contains TWO sitemap views — save each to their correct paths ?>

{{-- =========================================================== --}}
{{-- resources/views/sitemap/brands.blade.php                    --}}
{{-- =========================================================== --}}

<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Brand index --}}
    <url>
        <loc>{{ url('/brand') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @foreach($brands as $brand)
    <url>
        <loc>{{ url('/brand/' . $brand->slug) }}</loc>
        <lastmod>{{ $brand->updated_at->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
</urlset>
