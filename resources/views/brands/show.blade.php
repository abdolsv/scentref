@extends('layouts.app')
@section('title', $brand->name . ' Perfumes in Nigeria')
@section('canonical', route('brands.show', $brand->slug))

@section('jsonLd')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "Brands", "item": "{{ route('brands.index') }}" },
        { "@type": "ListItem", "position": 3, "name": "{{ addslashes($brand->name) }}", "item": "{{ route('brands.show', $brand->slug) }}" }
    ]
}
</script>
@endverbatim
@endsection

@section('content')
<header class="bg-obsidian text-ivory py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="font-display text-4xl font-bold">{{ $brand->name }} Fragrances</h1>
        <p class="text-ash mt-2">{{ $perfumes->total() }} items available in Nigeria</p>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($perfumes as $perfume)
            <x-perfume-card :perfume="$perfume" />
        @endforeach
    </div>
    <div class="mt-10">{{ $perfumes->links() }}</div>
</main>
@endsection
