{{-- resources/views/perfumes/index.blade.php --}}
@extends('layouts.app')

@php
    $title       = $pageTitle ?? 'All Perfumes in Nigeria — Prices, Reviews & Where to Buy';
    $description = 'Browse ' . $perfumes->total() . ' perfumes available in Nigeria with current NGN prices, heat longevity ratings, and verified buyer reviews.';
@endphp

@section('title', $title . ' | ScentRef')
@section('description', $description)

@section('content')

{{-- Page Header --}}
<section class="bg-obsidian text-ivory py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl md:text-4xl font-bold">
            {{ $pageTitle ?? 'All Perfumes in Nigeria' }}
        </h1>
        <p class="text-ash mt-2 text-sm">
            <span id="result-count">{{ $perfumes->total() }}</span> perfumes with Nigerian prices
        </p>
    </div>
</section>

{{-- Filter + Results --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
     x-data="filterPanel()"
     x-init="
        // Sync URL params into filters on page load
        (() => {
            const p = new URLSearchParams(location.search);
            if (p.get('q'))             filters.q = p.get('q');
            if (p.get('gender'))        filters.gender = p.get('gender');
            if (p.get('sort'))          filters.sort = p.get('sort');
            if (p.get('price_min'))     filters.price_min = p.get('price_min');
            if (p.get('price_max'))     filters.price_max = p.get('price_max');
            if (p.get('longevity_min')) filters.longevity_min = p.get('longevity_min');
            if (p.get('availability'))  filters.availability = p.get('availability');
            if (p.get('verdict'))       filters.verdict = p.get('verdict');
        })()
     ">

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ── SIDEBAR FILTERS ──────────────────────────────────── --}}
        <aside class="w-full lg:w-72 flex-shrink-0 space-y-6">

            {{-- Search --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-2">Search</label>
                <div class="flex gap-2">
                    <input
                        x-model="filters.q"
                        @keyup.enter="applyFilters()"
                        type="search"
                        placeholder="Name, brand, note…"
                        class="flex-1 border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gold"
                    >
                    <button @click="applyFilters()"
                            class="bg-gold text-obsidian px-3 py-2 rounded text-sm font-bold hover:bg-gold-dark">
                        Go
                    </button>
                </div>
            </div>

            {{-- Sort --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">Sort By</label>
                <select x-model="filters.sort" @change="applyFilters()"
                        class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gold">
                    <option value="rating">Highest Rated</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                    <option value="newest">Newest</option>
                    <option value="longevity">Best Heat Longevity</option>
                </select>
            </div>

            {{-- Gender --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">Gender</label>
                <div class="flex gap-2">
                    @foreach(['men' => 'Men', 'women' => 'Women', 'unisex' => 'Unisex'] as $val => $label)
                    <button
                        @click="toggleGender('{{ $val }}'); applyFilters()"
                        :class="filters.gender === '{{ $val }}'
                            ? 'bg-obsidian text-ivory'
                            : 'bg-gray-100 text-ink hover:bg-gray-200'"
                        class="flex-1 py-2 rounded text-xs font-semibold transition-colors"
                    >{{ $label }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Price Range --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">Price Range (₦)</label>
                <div class="space-y-2">
                    @foreach(config('scentref.price_tiers') as $key => $tier)
                    <button
                        @click="
                            filters.price_min = {{ $tier['min'] }};
                            filters.price_max = {{ $tier['max'] }};
                            applyFilters()
                        "
                        :class="filters.price_min == {{ $tier['min'] }} && filters.price_max == {{ $tier['max'] }}
                            ? 'border-gold text-gold font-semibold'
                            : 'border-gray-200 text-ink hover:border-gold'"
                        class="w-full text-left px-3 py-2 border rounded text-xs transition-colors"
                    >{{ $tier['label'] }}</button>
                    @endforeach
                    {{-- Custom range --}}
                    <div class="flex gap-2 pt-1">
                        <input x-model="filters.price_min" type="number" placeholder="Min"
                               class="w-full border rounded px-2 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-gold">
                        <input x-model="filters.price_max" type="number" placeholder="Max"
                               class="w-full border rounded px-2 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-gold">
                    </div>
                    <button @click="applyFilters()" class="w-full bg-gold text-obsidian py-1.5 rounded text-xs font-bold hover:bg-gold-dark mt-1">Apply Price</button>
                </div>
            </div>

            {{-- Brands --}}
            @if(isset($brands) && $brands->isNotEmpty())
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">Brand</label>
                <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                    @foreach($brands as $brand)
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input
                            type="checkbox"
                            :value="{{ $brand->id }}"
                            x-model="filters.brand_ids"
                            @change="applyFilters()"
                            class="w-4 h-4 accent-gold rounded"
                        >
                        <span class="text-sm text-ink group-hover:text-gold transition-colors">
                            {{ $brand->name }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Scent Families --}}
            @if(isset($scentFamilies) && $scentFamilies->isNotEmpty())
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">Scent Family</label>
                <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                    @foreach($scentFamilies as $family)
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input
                            type="checkbox"
                            :value="{{ $family->id }}"
                            x-model="filters.scent_family_ids"
                            @change="applyFilters()"
                            class="w-4 h-4 accent-gold rounded"
                        >
                        <span class="text-sm text-ink group-hover:text-gold transition-colors">
                            {{ $family->name }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Concentration --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">Concentration</label>
                <div class="space-y-2">
                    @foreach(['parfum' => 'Parfum', 'edp' => 'EDP', 'edt' => 'EDT', 'edc' => 'EDC', 'body_spray' => 'Body Spray', 'oil' => 'Oil'] as $val => $label)
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input
                            type="checkbox"
                            value="{{ $val }}"
                            x-model="filters.concentration"
                            @change="applyFilters()"
                            class="w-4 h-4 accent-gold rounded"
                        >
                        <span class="text-sm text-ink group-hover:text-gold transition-colors">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Heat Longevity --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">
                    Min Heat Longevity
                    <span x-text="filters.longevity_min ? filters.longevity_min + '/10' : 'Any'"
                          class="text-gold ml-1 font-mono"></span>
                </label>
                <input
                    type="range" min="1" max="10" step="1"
                    x-model="filters.longevity_min"
                    @change="applyFilters()"
                    class="w-full accent-gold"
                >
                <div class="flex justify-between text-[10px] text-ash mt-1">
                    <span>1</span><span>5</span><span>10</span>
                </div>
            </div>

            {{-- Availability --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">Availability</label>
                <div class="space-y-2">
                    @foreach(['available' => '✓ Available in Nigeria', 'import_only' => '↗ Import Only'] as $val => $label)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="availability" value="{{ $val }}"
                               x-model="filters.availability" @change="applyFilters()"
                               class="accent-gold">
                        <span class="text-sm text-ink">{{ $label }}</span>
                    </label>
                    @endforeach
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="availability" value=""
                               x-model="filters.availability" @change="applyFilters()"
                               class="accent-gold">
                        <span class="text-sm text-ash">Any</span>
                    </label>
                </div>
            </div>

            {{-- Verdict --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wide text-ash mb-3">Editor's Verdict</label>
                <div class="space-y-2">
                    @foreach(['must_buy' => '★ Must Buy', 'highly_recommended' => '✓ Highly Recommended', 'recommended' => 'Recommended'] as $val => $label)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="verdict" value="{{ $val }}"
                               x-model="filters.verdict" @change="applyFilters()"
                               class="accent-gold">
                        <span class="text-sm text-ink">{{ $label }}</span>
                    </label>
                    @endforeach
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="verdict" value=""
                               x-model="filters.verdict" @change="applyFilters()"
                               class="accent-gold">
                        <span class="text-sm text-ash">Any</span>
                    </label>
                </div>
            </div>

            {{-- Clear Filters --}}
            <button @click="clearFilters()"
                    class="w-full border border-gray-300 text-ash py-2 rounded text-sm hover:border-red-400 hover:text-red-500 transition-colors">
                ✕ Clear All Filters
            </button>
        </aside>

        {{-- ── RESULTS ───────────────────────────────────────────── --}}
        <div class="flex-1 min-w-0">
            {{-- Loading overlay --}}
            <div x-show="loading"
                 class="fixed inset-0 bg-obsidian/20 backdrop-blur-sm z-50 flex items-center justify-center">
                <div class="bg-white rounded-xl px-8 py-6 shadow-2xl flex items-center gap-4">
                    <svg class="animate-spin w-6 h-6 text-gold" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                    </svg>
                    <span class="text-ink font-semibold">Loading…</span>
                </div>
            </div>

            {{-- Grid container --}}
            <div id="perfume-grid">
                @include('components.perfume-grid', ['perfumes' => $perfumes])
            </div>
        </div>
    </div>
</div>

@endsection
