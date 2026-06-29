@extends('layouts.app')
@section('title', 'Access Denied — ScentRef')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-24 text-center">
    <p class="font-mono text-gold text-6xl font-bold mb-4">403</p>
    <h1 class="font-display text-3xl font-bold text-ink mb-4">Access Denied</h1>
    <p class="text-ash mb-8">You don't have permission to view this page.</p>
    <a href="{{ route('home') }}" class="btn-primary">← Back to Home</a>
</div>
@endsection
