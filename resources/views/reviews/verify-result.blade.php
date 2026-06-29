{{-- resources/views/reviews/verify-result.blade.php --}}
@extends('layouts.app')
@section('title', $success ? 'Review Verified — ScentRef' : 'Verification Failed — ScentRef')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-24 text-center">
    @if($success)
        <div class="text-6xl mb-6">✓</div>
        <h1 class="font-display text-3xl font-bold text-ink mb-4">Review Verified!</h1>
        <p class="text-ash mb-8">
            Your review has been verified and is now pending editorial approval.
            We'll publish it shortly. Thank you for contributing to Nigeria's fragrance community.
        </p>
        <a href="{{ route('home') }}" class="btn-primary">Back to ScentRef</a>
    @else
        <div class="text-6xl mb-6">✕</div>
        <h1 class="font-display text-3xl font-bold text-ink mb-4">Link Expired or Invalid</h1>
        <p class="text-ash mb-8">
            This verification link has already been used or has expired.
            If you submitted a review, it may already be verified.
        </p>
        <a href="{{ route('home') }}" class="btn-primary">Back to ScentRef</a>
    @endif
</div>
@endsection
