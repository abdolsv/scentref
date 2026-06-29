@extends("layouts.app")

@section("title", $seo["title"])
@section("description", $seo["description"])
@section("canonical", $seo["canonical"])
@section("og_image", $seo["og_image"] ?? "")

@section("jsonLd")
    @foreach($seo["jsonLd"] ?? [] as $schema)
        @if($schema)
            <script type="application/ld+json">{{ json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) }}</script>
        @endif
    @endforeach
@endsection

@section("content")

{{-- Hero Section --}}
<section class="bg-obsidian text-ivory">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="flex justify-center bg-white/5 rounded-2xl p-8">
                @if($perfume->bottle_image_path)
                    <img src="{{ Storage::url($perfume->bottle_image_path) }}" alt="{{ $perfume->name }} bottle" class="h-80 object-contain" loading="eager">
                @else
                    <div class="h-80 w-48 bg-white/10 rounded-lg flex items-center justify-center"><span class="text-ash text-sm">No image</span></div>
                @endif
            </div>
            <div>
                <p class="text-gold text-sm font-mono uppercase tracking-widest mb-2">
                    <a href="{{ route("brands.show", $perfume->brand->slug) }}" class="hover:underline">{{ $perfume->brand->name }}</a>
                </p>
                <h1 class="font-display text-4xl font-bold text-ivory mb-4">{{ $perfume->name }}</h1>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-gold text-obsidian text-xs font-bold font-mono px-3 py-1 rounded">{{ strtoupper($perfume->concentration) }}</span>
                    <span class="bg-white/10 text-ivory text-xs px-3 py-1 rounded">{{ ucfirst($perfume->gender_target) }}</span>
                    @if($perfume->scentFamily)
                    <a href="{{ route("scent-families.show", $perfume->scentFamily->slug) }}" class="bg-white/10 text-ivory text-xs px-3 py-1 rounded hover:bg-white/20">{{ $perfume->scentFamily->name }}</a>
                    @endif
                </div>
                <div class="bg-white/5 rounded-xl p-4 mb-6">
                    <p class="text-ash text-xs uppercase tracking-wide mb-1">Current Price in Nigeria</p>
                    <p class="font-mono text-gold text-3xl font-bold">{{ $perfume->price_range ?? "Price not listed" }}</p>
                </div>
                @if($perfume->our_verdict)
                <div class="inline-block bg-gold text-obsidian font-bold px-4 py-2 rounded-lg text-sm mb-4">
                    ★ {{ str_replace("_"," ",ucwords($perfume->our_verdict,"_")) }}
                </div>
                @endif
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <p class="text-ash text-xs mb-1">Lagos Heat Longevity</p>
                        <div class="rating-bar"><div class="rating-bar-fill" style="width:{{ ($perfume->longevity_heat ?? 0) * 10 }}%"></div></div>
                        <p class="font-mono text-gold text-sm mt-1">{{ $perfume->longevity_heat ?? "N/A" }}/10</p>
                    </div>
                    <div>
                        <p class="text-ash text-xs mb-1">AC Office Longevity</p>
                        <div class="rating-bar"><div class="rating-bar-fill" style="width:{{ ($perfume->longevity_ac ?? 0) * 10 }}%"></div></div>
                        <p class="font-mono text-gold text-sm mt-1">{{ $perfume->longevity_ac ?? "N/A" }}/10</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 space-y-10">
            <x-price-table :prices="$perfume->currentPrices" />
            <x-notes-pyramid :top="$perfume->topNotes" :heart="$perfume->heartNotes" :base="$perfume->baseNotes" />

            @if($perfume->review_summary)
            <section>
                <h2 class="font-display text-2xl font-bold text-ink mb-4">Our Verdict</h2>
                <div class="prose prose-lg max-w-none">{!! $perfume->review_summary !!}</div>
            </section>
            @endif

            @if($perfume->currentPrices->isNotEmpty())
            <section>
                <h2 class="font-display text-2xl font-bold text-ink mb-4">Price History</h2>
                <canvas id="price-chart" height="200"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        import("/resources/js/price-chart.js").then(m => {
                            m.initPriceChart("price-chart", @json($priceChartData ?? []));
                        });
                    });
                </script>
            </section>
            @endif

            @if($perfume->authenticity_tips)
            <section class="bg-amber-50 border border-amber-200 rounded-xl p-6">
                <h2 class="font-display text-xl font-bold text-amber-900 mb-3">⚠ Authenticity Tips</h2>
                <div class="text-amber-800 text-sm prose">{!! $perfume->authenticity_tips !!}</div>
            </section>
            @endif

            @if($perfume->alternatives->isNotEmpty())
            <x-alternatives-section :alternatives="$perfume->alternatives" />
            @endif

            <section>
                <h2 class="font-display text-2xl font-bold text-ink mb-6">Nigerian Buyer Reviews ({{ $perfume->approvedReviews->count() }})</h2>
                @forelse($perfume->approvedReviews as $review)
                    <x-review-card :review="$review" />
                @empty
                    <p class="text-ash text-sm">No reviews yet.</p>
                @endforelse
            </section>

            <x-review-form :perfume="$perfume" />
            <x-faq-section :perfume="$perfume" />
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <h3 class="font-semibold text-ink mb-3">Quick Facts</h3>
                <dl class="space-y-2 text-sm">
                    @if($perfume->year_released)<dt class="text-ash">Year</dt><dd class="font-mono">{{ $perfume->year_released }}</dd>@endif
                    <dt class="text-ash mt-2">Availability</dt>
                    <dd class="{{ $perfume->availability === 'available' ? 'text-green-600' : 'text-amber-600' }} font-semibold">
                        {{ $perfume->availability === 'available' ? 'Available in Nigeria' : 'Import Only' }}
                    </dd>
                </dl>
            </div>

            @php $occasions = is_array($perfume->best_occasion) ? $perfume->best_occasion : json_decode($perfume->best_occasion ?? '[]', true); @endphp
            @if(!empty($occasions))
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <h3 class="font-semibold text-ink mb-3">Best For</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($occasions as $occ)
                        <span class="bg-ivory text-ash text-xs px-3 py-1 rounded-full border">{{ ucfirst(str_replace("_"," ",$occ)) }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
