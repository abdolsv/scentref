{{-- resources/views/price-alerts/unsubscribed.blade.php --}}
@extends('layouts.app')
@section('title', 'Price Alert Cancelled — ScentRef')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-24 text-center">
    <div class="text-5xl mb-6">🔕</div>
    <h1 class="font-display text-3xl font-bold text-ink mb-4">Price Alert Cancelled</h1>
    <p class="text-ash mb-8">
        You've been unsubscribed from this price alert. You will no longer receive notifications
        for this fragrance.
    </p>
    <a href="{{ route('perfumes.index') }}" class="btn-primary">Browse Perfumes</a>
</div>
@endsection
