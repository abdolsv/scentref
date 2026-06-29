<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Brand extends Model
{
    use SoftDeletes, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'origin_country',
        'tier',
        'website_url',
        'logo_path',
        'nigeria_availability_note',
        'editor_note',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    /**
     * Boot the model to handle cache invalidation automatically.
     */
    protected static function booted(): void
    {
        // When a brand is saved (created or updated), flush the global brands index
        static::saved(fn() => Cache::forget('brands.index'));
        
        // When a brand is updated, flush its specific show page cache
        static::updated(fn(Brand $brand) => Cache::forget("brand.show.{$brand->slug}"));
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function perfumes(): HasMany
    {
        return $this->hasMany(Perfume::class);
    }

    public function publishedPerfumes(): HasMany
    {
        return $this->hasMany(Perfume::class)->where('is_published', true);
    }
}
