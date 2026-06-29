{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title", "ScentRef — Nigeria's Fragrance Reference")</title>
    <meta name="description" content="@yield("description", "The definitive guide to perfume prices, performance, and availability in Nigeria.")">
    <link rel="canonical" href="@yield("canonical", url()->current())">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield("og_title", "ScentRef.ng")">
    <meta property="og:description" content="@yield("description")">
    <meta property="og:image" content="@yield("og_image", asset("og-default.jpg"))">
    <meta property="og:type" content="website">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    {{-- Tailwind v4 + App CSS + JS via Vite --}}
    @vite(["resources/css/app.css", "resources/js/app.js"])

    {{-- JSON-LD Schema --}}
    @hasSection("jsonLd")
        @yield("jsonLd")
    @endif
</head>
<body class="bg-ivory font-body text-ink antialiased">

    {{-- Navigation --}}
    <nav class="bg-obsidian text-ivory sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route("home") }}" class="font-display text-xl font-bold text-gold">
                    ScentRef<span class="text-ivory opacity-60">.ng</span>
                </a>
                <div class="hidden md:flex items-center gap-6 text-sm">
                    <a href="{{ route("perfumes.index") }}" class="hover:text-gold transition-colors">Perfumes</a>
                    <a href="{{ route("brands.index") }}" class="hover:text-gold transition-colors">Brands</a>
                    <a href="{{ route("perfumes.men") }}" class="hover:text-gold transition-colors">Men</a>
                    <a href="{{ route("perfumes.women") }}" class="hover:text-gold transition-colors">Women</a>
                    <a href="{{ route("perfumes.under5k") }}" class="bg-gold text-obsidian px-3 py-1.5 rounded text-xs font-bold hover:bg-gold-light transition-colors">Under ₦5K</a>
                </div>
                {{-- Mobile menu toggle --}}
                <button x-data @click="$dispatch('toggle-menu')" class="md:hidden text-ivory p-2" aria-label="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    {{-- Mobile nav --}}
    <div x-data="{open:false}" @toggle-menu.window="open=!open" x-show="open" class="md:hidden bg-obsidian text-ivory px-4 pb-4">
        <a href="{{ route("perfumes.index") }}" class="block py-2 hover:text-gold">Perfumes</a>
        <a href="{{ route("brands.index") }}" class="block py-2 hover:text-gold">Brands</a>
        <a href="{{ route("perfumes.men") }}" class="block py-2 hover:text-gold">Men's</a>
        <a href="{{ route("perfumes.women") }}" class="block py-2 hover:text-gold">Women's</a>
        <a href="{{ route("perfumes.under5k") }}" class="block py-2 hover:text-gold">Under ₦5,000</a>
    </div>

    {{-- Main Content --}}
    <main>
        @yield("content")
    </main>

    {{-- Footer --}}
    <footer class="bg-obsidian text-ash mt-16 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <p class="font-display text-gold text-xl font-bold mb-3">ScentRef.ng</p>
                    <p class="text-sm">Nigeria's Fragrance Reference. Real prices. Real reviews. Built for Nigerian buyers.</p>
                </div>
                <div>
                    <p class="font-semibold text-ivory mb-3 text-sm uppercase tracking-wide">Browse</p>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route("perfumes.index") }}" class="hover:text-gold">All Perfumes</a></li>
                        <li><a href="{{ route("brands.index") }}" class="hover:text-gold">All Brands</a></li>
                        <li><a href="{{ route("perfumes.men") }}" class="hover:text-gold">For Men</a></li>
                        <li><a href="{{ route("perfumes.women") }}" class="hover:text-gold">For Women</a></li>
                    </ul>
                </div>
                <div>
                    <p class="font-semibold text-ivory mb-3 text-sm uppercase tracking-wide">Budget</p>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route("perfumes.under5k") }}" class="hover:text-gold">Under ₦5,000</a></li>
                        <li><a href="{{ route("perfumes.under10k") }}" class="hover:text-gold">Under ₦10,000</a></li>
                        <li><a href="{{ route("perfumes.under20k") }}" class="hover:text-gold">Under ₦20,000</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 mt-8 pt-6 text-xs text-center">
                © {{ date("Y") }} ScentRef.ng · <a href="/sitemap.xml" class="hover:text-gold">Sitemap</a>
            </div>
        </div>
    </footer>

</body>
</html>

