<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Perfume;
use App\Services\SeoService;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display perfumes that match a specific olfactive note layer.
     */
    public function show(string $slug): View
    {
        $note = Note::where('slug', $slug)->firstOrFail();

        $perfumes = Perfume::where('is_published', true)
            ->where(function ($query) use ($note) {
                $query->whereHas('topNotes', function ($n) use ($note) {
                    $n->where('notes.id', $note->id);
                })
                ->orWhereHas('heartNotes', function ($n) use ($note) {
                    $n->where('notes.id', $note->id);
                })
                ->orWhereHas('baseNotes', function ($n) use ($note) {
                    $n->where('notes.id', $note->id);
                });
            })
            ->with(['brand', 'currentPrices.vendor'])
            ->paginate(24);

        $seo = app(SeoService::class)->forNote($note, $perfumes->total());

        return view('notes.show', compact('note', 'perfumes', 'seo'));
    }
}
