{{-- resources/views/notes/show.blade.php --}}
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
            <span class="text-ivory">{{ $note->name }} Note</span>
        </nav>
        <h1 class="font-display text-3xl md:text-4xl font-bold">
            Perfumes with <span class="text-gold">{{ $note->name }}</span> Note
        </h1>
        <p class="text-ash mt-2 text-sm">{{ $perfumes->total() }} perfumes in Nigeria featuring {{ $note->name }}</p>
        @if($note->description)
        <p class="text-ash mt-4 max-w-2xl text-sm leading-relaxed">{{ $note->description }}</p>
        @endif
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if($perfumes->isEmpty())
        <p class="text-center text-ash py-20">No perfumes found with this note yet.</p>
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
