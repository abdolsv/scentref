<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Perfume extends Model
{
    use HasFactory, SoftDeletes, Searchable, HasSlug;

    protected $fillable = [
        "name","slug","brand_id","scent_family_id","year_released","perfumer",
        "gender_target","concentration","collection_line","official_description",
        "opening_character","drydown_character","longevity_notes",
        "longevity_heat","longevity_ac","longevity_hours_avg","sillage_rating",
        "projection","best_season_nigeria","best_occasion",
        "availability","avg_price_ngn","physical_store_cities","last_price_updated",
        "import_difficulty","bottle_image_path","box_image_path",
        "official_website_url","fragrantica_url","review_summary","pw_rating",
        "who_should_buy","who_should_avoid","our_verdict","authenticity_tips",
        "meta_title","meta_description","is_complete","is_published","published_at",
    ];

    protected $casts = [
        "best_season_nigeria"    => "array",
        "best_occasion"          => "array",
        "physical_store_cities"  => "array",
        "published_at"           => "datetime",
        "last_price_updated"     => "date",
        "is_complete"            => "boolean",
        "is_published"           => "boolean",
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom("name")->saveSlugsTo("slug");
    }

    // ── Relationships ─────────────────────────────────────────────────

    public function brand(): BelongsTo
    { return $this->belongsTo(Brand::class); }

    public function scentFamily(): BelongsTo
    { return $this->belongsTo(ScentFamily::class); }

    public function topNotes(): BelongsToMany
    { return $this->belongsToMany(Note::class, "perfume_notes")
                  ->wherePivot("position", "top"); }

    public function heartNotes(): BelongsToMany
    { return $this->belongsToMany(Note::class, "perfume_notes")
                  ->wherePivot("position", "heart"); }

    public function baseNotes(): BelongsToMany
    { return $this->belongsToMany(Note::class, "perfume_notes")
                  ->wherePivot("position", "base"); }

    public function prices(): HasMany
    { return $this->hasMany(Price::class); }

    public function currentPrices(): HasMany
    { return $this->hasMany(Price::class)->where("is_current", true)->with("vendor"); }

    public function reviews(): HasMany
    { return $this->hasMany(Review::class); }

    public function approvedReviews(): HasMany
    { return $this->hasMany(Review::class)->where("status", "approved")
                  ->orderByDesc("created_at"); }

    public function alternatives(): BelongsToMany
    { return $this->belongsToMany(Perfume::class,
                "perfume_alternatives", "source_perfume_id", "alternative_perfume_id")
                ->withPivot(["relationship_type","editorial_note","price_tier","sort_order"])
                ->orderByPivot("sort_order"); }

    public function priceAlerts(): HasMany
    { return $this->hasMany(PriceAlert::class); }

    // ── Accessors ─────────────────────────────────────────────────────

    public function getAverageRatingAttribute(): ?float
    { return $this->approvedReviews()->avg("rating_overall"); }

    public function getPriceRangeAttribute(): ?string
    {
        $prices = $this->currentPrices->pluck("price_ngn");
        if ($prices->isEmpty()) return null;
        $min = $prices->min(); $max = $prices->max();
        return $min === $max
            ? "₦".number_format($min)
            : "₦".number_format($min)."–₦".number_format($max);
    }

    // ── Scout (Meilisearch) ───────────────────────────────────────────

    public function toSearchableArray(): array
    {
        return [
            "id"           => $this->id,
            "name"         => $this->name,
            "brand"        => $this->brand?->name ?? "",
            "notes"        => $this->topNotes->pluck("name")
                                  ->merge($this->heartNotes->pluck("name"))
                                  ->merge($this->baseNotes->pluck("name"))
                                  ->implode(" "),
            "scent_family" => $this->scentFamily?->name ?? "",
            "gender"       => $this->gender_target,
            "price"        => $this->avg_price_ngn,
            "concentration"=> $this->concentration,
        ];
    }

    public function shouldBeSearchable(): bool
    { return $this->is_published; }
}

