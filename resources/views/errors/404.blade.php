@extends('layouts.app')
@section('title', 'Page Not Found — ScentRef')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-24 text-center">
    <p class="font-mono text-gold text-6xl font-bold mb-4">404</p>
    <h1 class="font-display text-3xl font-bold text-ink mb-4">Page Not Found</h1>
    <p class="text-ash mb-8">This fragrance seems to have evaporated. The page you're looking for doesn't exist.</p>
    <a href="{{ route('home') }}" class="btn-primary">← Back to Home</a>
</div>
@endsection
