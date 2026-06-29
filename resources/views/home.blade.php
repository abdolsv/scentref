{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', "ScentRef.ng — Nigeria's Fragrance Reference | Prices, Reviews & Where to Buy")
@section('description', "The definitive Nigerian perfume database. Real NGN prices, longevity ratings for Lagos heat, and verified buyer reviews from Nigerians.")
@section('canonical', url('/'))

@section('jsonLd')

@verbatim

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "ScentRef.ng",
    "url": "{{ url('/') }}",
    "description": "Nigeria's Fragrance Reference — perfume prices, reviews, and availability in Nigeria.",
    "potentialAction": {
        "@type": "SearchAction",
        "target": {
            "@type": "EntryPoint",
            "urlTemplate": "{{ url('/perfume') }}?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
    }
}
</script>
@endverbatim

@endsection

@section('content')

{{-- ── HERO ──────────────────────────────────────────────────────── --}}
<section class="bg-obsidian text-ivory relative overflow-hidden">
    {{-- Subtle texture overlay --}}
    <div class="absolute inset-0 opacity-5"
         style="background-image: repeating-linear-gradient(45deg, #C9A84C 0, #C9A84C 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
        <div class="max-w-3xl">
            <p class="font-mono text-gold text-sm uppercase tracking-widest mb-4">Nigeria's Fragrance Reference</p>
            <h1 class="font-display text-5xl md:text-6xl font-bold text-ivory leading-tight mb-6">
                Find Your Perfect<br>
                <span class="text-gold">Scent in Nigeria</span>
            </h1>
            <p class="text-ash text-lg md:text-xl mb-10 leading-relaxed">
                Real prices in Nigerian Naira. Longevity ratings tested in Lagos heat.
                Verified buyer reviews from Nigerians like you.
            </p>

            {{-- Search Bar --}}
            <div class="flex gap-3 max-w-xl" x-data="{ q: '' }">
                <input
                    x-model="q"
                    @keyup.enter="window.location.href = '/perfume?q=' + encodeURIComponent(q)"
                    type="search"
                    placeholder="Search perfume, brand, or note…"
                    class="flex-1 bg-white/10 text-ivory placeholder-ash border border-white/20 rounded-lg px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent"
                >
                <button
                    @click="window.location.href = '/perfume?q=' + encodeURIComponent(q)"
                    class="btn-primary whitespace-nowrap text-sm px-5 py-3"
                >
                    Search
                </button>
            </div>

            {{-- Quick Stats --}}
            @if(isset($stats))
            <div class="flex flex-wrap gap-6 mt-10 text-sm">
                <div>
                    <span class="font-mono text-gold font-bold text-2xl">{{ number_format($stats['perfumes']) }}</span>
                    <span class="text-ash ml-2">Perfumes</span>
                </div>
                <div>
                    <span class="font-mono text-gold font-bold text-2xl">{{ number_format($stats['brands']) }}</span>
                    <span class="text-ash ml-2">Brands</span>
                </div>
                <div>
                    <span class="font-mono text-gold font-bold text-2xl">{{ number_format($stats['notes']) }}</span>
                    <span class="text-ash ml-2">Notes Indexed</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- ── QUICK NAV PILLS ───────────────────────────────────────────── --}}
<section class="bg-white border-b border-gray-100 sticky top-16 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-3 scrollbar-hide">
            <a href="{{ route('perfumes.index') }}"
               class="whitespace-nowrap text-xs font-semibold px-4 py-2 rounded-full bg-obsidian text-ivory hover:bg-gold hover:text-obsidian transition-colors">
                All Perfumes
            </a>
            <a href="{{ route('perfumes.men') }}"
               class="whitespace-nowrap text-xs font-semibold px-4 py-2 rounded-full border border-gray-200 text-ink hover:border-gold hover:text-gold transition-colors">
                For Men
            </a>
            <a href="{{ route('perfumes.women') }}"
               class="whitespace-nowrap text-xs font-semibold px-4 py-2 rounded-full border border-gray-200 text-ink hover:border-gold hover:text-gold transition-colors">
                For Women
            </a>
            <a href="{{ route('perfumes.unisex') }}"
               class="whitespace-nowrap text-xs font-semibold px-4 py-2 rounded-full border border-gray-200 text-ink hover:border-gold hover:text-gold transition-colors">
                Unisex
            </a>
            <a href="{{ route('perfumes.under5k') }}"
               class="whitespace-nowrap text-xs font-semibold px-4 py-2 rounded-full border border-gold text-gold hover:bg-gold hover:text-obsidian transition-colors">
                Under ₦5,000
            </a>
            <a href="{{ route('perfumes.under10k') }}"
               class="whitespace-nowrap text-xs font-semibold px-4 py-2 rounded-full border border-gray-200 text-ink hover:border-gold hover:text-gold transition-colors">
                Under ₦10,000
            </a>
            <a href="{{ route('perfumes.under20k') }}"
               class="whitespace-nowrap text-xs font-semibold px-4 py-2 rounded-full border border-gray-200 text-ink hover:border-gold hover:text-gold transition-colors">
                Under ₦20,000
            </a>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-16">

    {{-- ── MUST-BUY / FEATURED ──────────────────────────────────── --}}
    @if($featured->isNotEmpty())
    <section>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-display text-2xl font-bold text-ink">★ Must-Buy Fragrances</h2>
                <p class="text-ash text-sm mt-1">Editor-verified picks for Nigerian buyers</p>
            </div>
            <a href="{{ route('perfumes.index') }}" class="text-gold text-sm font-semibold hover:underline">
                View all →
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($featured as $perfume)
                <x-perfume-card :perfume="$perfume" />
            @endforeach
        </div>
    </section>
    @endif

    {{-- ── SCENT FAMILIES ───────────────────────────────────────── --}}
    @if($scentFamilies->isNotEmpty())
    <section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-display text-2xl font-bold text-ink">Browse by Scent Family</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($scentFamilies as $family)
            <a href="{{ route('scent-families.show', $family->slug) }}"
               class="card p-4 text-center group">
                @if($family->icon)
                <span class="text-3xl block mb-2">{{ $family->icon }}</span>
                @endif
                <p class="font-semibold text-ink text-sm group-hover:text-gold transition-colors">
                    {{ $family->name }}
                </p>
                <p class="text-ash text-xs mt-1">{{ $family->published_count }} perfumes</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ── TOP RATED ─────────────────────────────────────────────── --}}
    @if($topRated->isNotEmpty())
    <section>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-display text-2xl font-bold text-ink">Highest Rated in Nigeria</h2>
                <p class="text-ash text-sm mt-1">Ranked by ScentRef editorial score</p>
            </div>
            <a href="{{ route('perfumes.index') }}?sort=rating" class="text-gold text-sm font-semibold hover:underline">
                See all →
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($topRated as $perfume)
                <x-perfume-card :perfume="$perfume" />
            @endforeach
        </div>
    </section>
    @endif

    {{-- ── BUDGET PICKS ──────────────────────────────────────────── --}}
    @if($budget->isNotEmpty())
    <section class="bg-ivory rounded-2xl p-8 -mx-4 sm:mx-0">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-display text-2xl font-bold text-ink">Under ₦5,000</h2>
                <p class="text-ash text-sm mt-1">Great fragrances on a budget</p>
            </div>
            <a href="{{ route('perfumes.under5k') }}" class="text-gold text-sm font-semibold hover:underline">
                All budget picks →
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($budget as $perfume)
                <x-perfume-card :perfume="$perfume" />
            @endforeach
        </div>
    </section>
    @endif

    {{-- ── BRANDS ────────────────────────────────────────────────── --}}
    @if($brands->isNotEmpty())
    <section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-display text-2xl font-bold text-ink">Top Brands in Nigeria</h2>
            <a href="{{ route('brands.index') }}" class="text-gold text-sm font-semibold hover:underline">
                All brands →
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($brands as $brand)
            <a href="{{ route('brands.show', $brand->slug) }}"
               class="card p-4 text-center group">
                @if($brand->logo_path)
                <img src="{{ Storage::url($brand->logo_path) }}"
                     alt="{{ $brand->name }} logo"
                     class="h-10 w-auto mx-auto mb-3 object-contain grayscale group-hover:grayscale-0 transition-all">
                @else
                <div class="h-10 w-10 mx-auto mb-3 bg-obsidian/10 rounded-full flex items-center justify-center">
                    <span class="font-display font-bold text-obsidian text-sm">{{ substr($brand->name, 0, 1) }}</span>
                </div>
                @endif
                <p class="font-semibold text-ink text-xs group-hover:text-gold transition-colors">{{ $brand->name }}</p>
                <p class="text-ash text-xs">{{ $brand->published_count }} perfumes</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ── WHY SCENTREF ──────────────────────────────────────────── --}}
    <section class="bg-obsidian text-ivory rounded-2xl p-10">
        <h2 class="font-display text-3xl font-bold text-center mb-10">
            Built for <span class="text-gold">Nigerian</span> Fragrance Buyers
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-4xl mb-4">☀</div>
                <h3 class="font-semibold text-ivory mb-2">Heat-Tested Ratings</h3>
                <p class="text-ash text-sm leading-relaxed">Every fragrance is rated for Lagos outdoor heat and AC office performance — not just European temperatures.</p>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-4">₦</div>
                <h3 class="font-semibold text-ivory mb-2">Real Nigerian Prices</h3>
                <p class="text-ash text-sm leading-relaxed">Current Naira prices from Jumia, Konga, and local vendors — updated weekly with price history charts.</p>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-4">✓</div>
                <h3 class="font-semibold text-ivory mb-2">Authenticity Tips</h3>
                <p class="text-ash text-sm leading-relaxed">Every listing includes verified authenticity checks so you never buy a fake from local markets.</p>
            </div>
        </div>
    </section>

</div>

@endsection
