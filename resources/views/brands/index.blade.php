@extends('layouts.app')
@section('title', 'All Perfume Brands in Nigeria — Prices & Reviews | ScentRef')

@section('content')
<section class="bg-obsidian text-ivory py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl font-bold">Perfume Brands in Nigeria</h1>
        <p class="text-ash mt-2">{{ $brands->count() }} curated brands</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-10">
    @php
        $tiers = ['luxury' => 'Luxury', 'designer' => 'Designer', 'niche' => 'Niche', 'arabian' => 'Middle Eastern', 'budget' => 'Budget'];
        $grouped = $brands->groupBy('tier');
    @endphp

    @foreach($tiers as $key => $label)
        @if(isset($grouped[$key]))
            <section class="mb-12">
                <h2 class="font-display text-xl font-bold text-ink mb-6 border-b pb-2">{{ $label }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($grouped[$key]->sortBy('name') as $brand)
                        <a href="{{ route('brands.show', $brand->slug) }}" class="card p-4 text-center hover:shadow-lg transition-all">
                            <img src="{{ $brand->logo_path ? Storage::url($brand->logo_path) : asset('img/placeholder.png') }}" 
                                 class="h-12 w-auto mx-auto mb-3 object-contain" alt="{{ $brand->name }}">
                            <p class="font-semibold text-ink text-xs">{{ $brand->name }}</p>
                            <p class="text-ash text-[10px]">{{ $brand->published_count }} perfumes</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach
</div>
@endsection
