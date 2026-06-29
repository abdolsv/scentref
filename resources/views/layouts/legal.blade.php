{{-- resources/views/layouts/legal.blade.php --}}
@extends('layouts.app')

@section('title', $title ?? 'Legal — ScentRef.com')
@section('description', $description ?? '')

@section('content')

{{-- Legal page header --}}
<section class="bg-obsidian text-ivory py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-ash text-xs mb-3">
            <a href="{{ route('home') }}" class="hover:text-gold">Home</a>
            <span class="mx-2">/</span>
            <span class="text-ivory">@yield('breadcrumb', 'Legal')</span>
        </nav>
        <h1 class="font-display text-3xl font-bold">@yield('heading')</h1>
        @hasSection('subheading')
        <p class="text-ash mt-2 text-sm">@yield('subheading')</p>
        @endif
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-10">

        {{-- Sidebar: Section anchor nav --}}
        <aside class="lg:w-56 flex-shrink-0">
            <div class="sticky top-24 bg-white rounded-xl border border-gray-100 p-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-ash mb-3">On This Page</p>
                <nav class="space-y-1 text-sm" id="legal-toc">
                    @yield('toc')
                </nav>

                <div class="mt-6 pt-5 border-t border-gray-100 space-y-1 text-xs text-ash">
                    <p class="font-semibold text-ink mb-2">Legal Pages</p>
                    <a href="{{ route('terms') }}"     class="block hover:text-gold py-0.5 transition-colors">Terms & Conditions</a>
                    <a href="{{ route('privacy') }}"   class="block hover:text-gold py-0.5 transition-colors">Privacy Policy</a>
                    <a href="{{ route('cookies') }}"   class="block hover:text-gold py-0.5 transition-colors">Cookie Policy</a>
                    <a href="{{ route('disclaimer') }}" class="block hover:text-gold py-0.5 transition-colors">Disclaimer</a>
                </div>
            </div>
        </aside>

        {{-- Main content --}}
        <main class="flex-1 min-w-0 prose prose-sm max-w-none
                     prose-headings:font-display prose-headings:text-ink
                     prose-h2:text-xl prose-h2:font-bold prose-h2:mt-10 prose-h2:mb-4
                     prose-h3:text-base prose-h3:font-semibold prose-h3:mt-6 prose-h3:mb-2
                     prose-p:text-ash prose-p:leading-relaxed
                     prose-li:text-ash prose-li:leading-relaxed
                     prose-a:text-gold prose-a:no-underline hover:prose-a:underline
                     prose-strong:text-ink">
            @yield('legal-content')
        </main>

    </div>
</div>

{{-- Smooth scroll spy for TOC --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('h2[id]');
    const links    = document.querySelectorAll('#legal-toc a');
    if (!sections.length || !links.length) return;

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(l => l.classList.remove('text-gold', 'font-semibold'));
                const active = document.querySelector(`#legal-toc a[href="#${entry.target.id}"]`);
                if (active) active.classList.add('text-gold', 'font-semibold');
            }
        });
    }, { rootMargin: '-20% 0px -75% 0px' });

    sections.forEach(s => observer.observe(s));
});
</script>

@endsection
