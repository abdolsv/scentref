{{-- resources/views/scent-families/show.blade.php --}}
@extends('layouts.app')
@section('title', $seo['title'])
@section('description', $seo['description'])
@section('canonical', $seo['canonical'])

@section('content')
<section class="bg-obsidian text-ivory py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-ash text-xs mb-4">
            <a href="{{ route('home') }}" class="hover:text-gold">Home</a>
            <span class="mx-2">/</span>
            <span class="text-ivory">{{ $family->name }}</span>
        </nav>
        <div class="flex items-center gap-4">
            @if($family->icon)
            <span class="text-5xl">{{ $family->icon }}</span>
            @endif
            <div>
                <h1 class="font-display text-3xl md:text-4xl font-bold">
                    {{ $family->name }} Perfumes in Nigeria
                </h1>
                <p class="text-ash mt-2 text-sm">{{ $perfumes->total() }} fragrances with Nigerian prices</p>
            </div>
        </div>
        @if($family->description)
        <p class="text-ash mt-4 max-w-2xl text-sm leading-relaxed">{{ $family->description }}</p>
        @endif
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if($perfumes->isEmpty())
        <p class="text-center text-ash py-20">No perfumes found in this scent family yet.</p>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($perfumes as $perfume)
                <x-perfume-card :perfume="$perfume" />
            @endforeach
        </div>
        @if($perfumes->hasPages())
        <div class="mt-10">{{ $perfumes->links() }}</div>
        @endif
    @endif
</div>
@endsection
