<?php
namespace App\Services;

use App\Models\Perfume;
use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    public function buildQuery(array $filters): Builder
    {
        // If text search query, get matching IDs from Meilisearch first
        $searchIds = null;
        if (!empty($filters['q']) && strlen($filters['q']) >= 2) {
            try {
                $searchIds = Perfume::search($filters['q'])
                    ->where('is_published', true)
                    ->keys()
                    ->toArray();

                // If no results from Meilisearch, fall back to LIKE
                if (empty($searchIds)) {
                    $term = '%' . $filters['q'] . '%';
                    $searchIds = Perfume::where('is_published', true)
                        ->where(function ($q) use ($term) {
                            $q->where('name', 'LIKE', $term)
                              ->orWhereHas('brand', fn($b) => $b->where('name', 'LIKE', $term));
                        })
                        ->pluck('id')
                        ->toArray();
                }
            } catch (\Exception $e) {
                // Meilisearch unavailable — fall back to LIKE
                $term = '%' . $filters['q'] . '%';
                $searchIds = Perfume::where('is_published', true)
                    ->where(function ($q) use ($term) {
                        $q->where('name', 'LIKE', $term)
                          ->orWhereHas('brand', fn($b) => $b->where('name', 'LIKE', $term));
                    })
                    ->pluck('id')
                    ->toArray();
            }
        }

        $q = Perfume::query()
            ->with(['brand', 'scentFamily', 'currentPrices.vendor'])
            ->where('is_published', true);

        // Apply search IDs constraint
        if ($searchIds !== null) {
            if (empty($searchIds)) {
                // No results — force empty result set
                $q->whereRaw('1 = 0');
            } else {
                $q->whereIn('id', $searchIds);
            }
        }

        if (!empty($filters['brand_ids'])) {
            $q->whereIn('brand_id', $filters['brand_ids']);
        }

        if (!empty($filters['scent_family_ids'])) {
            $q->whereIn('scent_family_id', $filters['scent_family_ids']);
        }

        if (!empty($filters['gender'])) {
            $q->where('gender_target', $filters['gender']);
        }

        if (!empty($filters['concentration'])) {
            $q->whereIn('concentration', (array) $filters['concentration']);
        }

        if (!empty($filters['price_min']) || !empty($filters['price_max'])) {
            $q->whereBetween('avg_price_ngn', [
                $filters['price_min'] ?? 0,
                $filters['price_max'] ?? 9_999_999,
            ]);
        }

        if (!empty($filters['occasion'])) {
            $q->whereJsonContains('best_occasion', $filters['occasion']);
        }

        if (!empty($filters['note_ids'])) {
            $noteIds = (array) $filters['note_ids'];
            $q->where(function ($sub) use ($noteIds) {
                $sub->whereHas('topNotes', fn($n) => $n->whereIn('notes.id', $noteIds))
                    ->orWhereHas('heartNotes', fn($n) => $n->whereIn('notes.id', $noteIds))
                    ->orWhereHas('baseNotes', fn($n) => $n->whereIn('notes.id', $noteIds));
            });
        }

        if (!empty($filters['longevity_min'])) {
            $q->where('longevity_heat', '>=', (int) $filters['longevity_min']);
        }

        if (!empty($filters['availability'])) {
            $q->where('availability', $filters['availability']);
        }

        if (!empty($filters['verdict'])) {
            $q->where('our_verdict', $filters['verdict']);
        }

        match ($filters['sort'] ?? 'rating') {
            'price_asc'  => $q->orderBy('avg_price_ngn'),
            'price_desc' => $q->orderByDesc('avg_price_ngn'),
            'newest'     => $q->orderByDesc('published_at'),
            'longevity'  => $q->orderByDesc('longevity_heat'),
            default      => $q->orderByDesc('pw_rating'),
        };

        return $q;
    }
}
