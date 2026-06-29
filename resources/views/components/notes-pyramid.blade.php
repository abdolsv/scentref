props(["top","heart","base"])
<section class="bg-white rounded-xl border border-gray-100 p-5">
    <h2 class="font-display text-xl font-bold text-ink mb-5">Fragrance Notes</h2>
    <div class="space-y-4">
        @if($top->isNotEmpty())
        <div>
            <p class="text-xs text-ash uppercase tracking-wider mb-2">Top Notes</p>
            <div class="flex flex-wrap gap-2">
                @foreach($top as $note)
                <a href="{{ route("notes.show", $note->slug) }}"
                   class="bg-gold/10 text-gold-dark border border-gold/30 text-xs px-3 py-1 rounded-full hover:bg-gold/20 transition-colors">
                   {{ $note->name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif
        @if($heart->isNotEmpty())
        <div>
            <p class="text-xs text-ash uppercase tracking-wider mb-2">Heart Notes</p>
            <div class="flex flex-wrap gap-2">
                @foreach($heart as $note)
                <a href="{{ route("notes.show", $note->slug) }}"
                   class="bg-obsidian/5 text-ink border border-obsidian/10 text-xs px-3 py-1 rounded-full hover:bg-obsidian/10 transition-colors">
                   {{ $note->name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif
        @if($base->isNotEmpty())
        <div>
            <p class="text-xs text-ash uppercase tracking-wider mb-2">Base Notes</p>
            <div class="flex flex-wrap gap-2">
                @foreach($base as $note)
                <a href="{{ route("notes.show", $note->slug) }}"
                   class="bg-amber-50 text-amber-800 border border-amber-200 text-xs px-3 py-1 rounded-full hover:bg-amber-100 transition-colors">
                   {{ $note->name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
