{{-- resources/views/about.blade.php --}}
@extends('layouts.app')
@section('title', 'About ScentRef.ng — Nigeria\'s Fragrance Intelligence Platform')
@section('description', 'ScentRef.ng is Nigeria\'s definitive fragrance reference — real NGN prices, heat-tested longevity ratings, and verified buyer reviews from Nigerian fragrance enthusiasts.')
@section('canonical', route('about'))

@section('content')

{{-- Hero Section --}}
<section class="bg-obsidian text-ivory py-20 border-b border-white/5">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-gold text-xs font-bold uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">Fragrance Intelligence</span>
        <h1 class="font-display text-4xl sm:text-5xl font-extrabold mt-4 mb-4">About <span class="text-gold">ScentRef.ng</span></h1>
        <p class="text-ash text-lg sm:text-xl font-medium leading-relaxed max-w-2xl">
            The definitive Nigerian fragrance reference. Built by enthusiasts, engineered for local climates, and anchored in real Naira pricing.
        </p>
    </div>
</section>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">

    {{-- Mission Statement --}}
    <section class="prose prose-lg max-w-none">
        <h2 class="font-display text-2xl sm:text-3xl font-bold text-ink mb-6">Why ScentRef Exists</h2>
        <div class="space-y-4 text-ash leading-relaxed">
            <p>
                Buying fragrance in Nigeria presents a very distinct set of challenges. Western perfume reviews can't tell you how an Eau de Toilette holds up in <span class="text-ink font-semibold">35°C Lagos humidity</span> or whether it can survive a gritty afternoon in Abuja. International perfume blogs quote far-off USD prices that bear zero resemblance to what you will actually pay at Trade Fair, Balogun Market, or via specialized local vendors.
            </p>
            <p>
                Worse yet, the proliferation of high-grade fakes—especially targeting popular designer fragrances—means navigating the local landscape blindly is an expensive gamble.
            </p>
            <p>
                <span class="text-ink font-semibold">ScentRef was built to eliminate the guesswork.</span> Every entry in our centralized database is explicitly evaluated with Nigerian parameters in mind: outdoor heat persistence, dry Harmattan performance, centralized AC office projection, and live pricing tracking across trusted local sellers.
            </p>
        </div>
    </section>

    <hr class="border-gray-100" />

    {{-- Features Core Grid --}}
    <section>
        <div class="mb-8">
            <h2 class="font-display text-2xl font-bold text-ink">What We Track</h2>
            <p class="text-ash text-sm mt-1">Data points meticulously collected for the Nigerian fragrance buyer</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '☀', 'title' => 'Climate Metrics', 'desc' => 'Every scent is tested and graded for intense outdoor heat, climate-controlled environments, and Harmattan resilience.'],
                ['icon' => '₦', 'title' => 'Live Naira Tracking', 'desc' => 'Real price aggregation across Jumia, Konga, and niche boutiques—complemented by historically accurate price charts.'],
                ['icon' => '✓', 'title' => 'Authenticity Blueprints', 'desc' => 'Granular, batch-specific code indicators and spot-the-fake breakdown checklists for high-risk designer items.'],
                ['icon' => '★', 'title' => 'Objective Verdicts', 'desc' => 'Unbiased editorial scoreboards including uncompromising "Buy If" and "Skip If" matrix breakdowns.'],
                ['icon' => '🔔', 'title' => 'Naira Price Triggers', 'desc' => 'Configure localized price benchmarks and receive real-time email alerts when a vendor drops to your target budget.'],
                ['icon' => '💬', 'title' => 'Demographic Context', 'desc' => 'Crowdsourced insights from local buyers with specific location tracking (e.g., Lagos, Port Harcourt, Kano).'],
            ] as $item)
            <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="text-2xl text-gold mb-4 w-10 h-10 bg-gold/5 rounded-lg flex items-center justify-center">{{ $item['icon'] }}</div>
                <h3 class="font-bold text-ink text-base mb-2">{{ $item['title'] }}</h3>
                <p class="text-ash text-xs leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Transparency Notice --}}
    <section class="bg-ivory border border-gray-100 rounded-2xl p-8">
        <h2 class="font-display text-xl font-bold text-ink mb-3">Transparency & Affiliate Disclosure</h2>
        <p class="text-ash text-sm leading-relaxed">
            Certain vendor redirection buttons across ScentRef.ng—specifically links navigating to ecosystems like Jumia or Konga—utilize tracking affiliate parameters. This means we may secure a nominal commission if you finalize an acquisition, strictly at zero extra overhead to your final invoice. 
        </p>
        <p class="text-ash text-sm leading-relaxed mt-3">
            This architectural model is what ensures our analytical directory remains permanently free to navigate. Most importantly: <span class="text-ink font-semibold">Our editorial benchmarks are entirely unpurchasable.</span> If a fragrance falls flat or fails under local heat stress, our scoring metrics will confidently reflect that.
        </p>
    </section>

    {{-- CTA / Interaction Layer --}}
    <section class="text-center bg-obsidian text-ivory rounded-2xl p-10 relative overflow-hidden">
        <div class="absolute inset-0 bg-radial-gradient from-gold/5 to-transparent pointer-events-none"></div>
        <h2 class="font-display text-2xl font-bold mb-3">Help Us Calibrate the Database</h2>
        <p class="text-ash text-sm max-w-lg mx-auto mb-8">
            Spot a price delta in the market? Want to report a suspicious batch or provide a climate-performance field report? Let us know.
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-gold hover:bg-gold/90 text-obsidian px-6 py-3 rounded-xl font-bold text-sm tracking-wide transition-colors duration-200 shadow-lg shadow-gold/10">
            Submit a Data Correction
        </a>
    </section>

</div>
@endsection
