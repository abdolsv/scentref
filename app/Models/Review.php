<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'perfume_id',
        'user_id',
        'reviewer_name',
        'reviewer_email',
        'reviewer_city',
        'reviewer_climate',
        'rating_overall',
        'rating_longevity',
        'rating_sillage',
        'rating_value',
        'purchase_source',
        'purchase_price_ngn',
        'review_title',
        'review_body',
        'verified_purchase',
        'helpful_votes',
        'status',
        'verification_token',
        'email_verified_at',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'approved_at' => 'datetime',
        'verified_purchase' => 'boolean',
        'rating_overall' => 'integer',
        'rating_longevity' => 'integer',
        'rating_sillage' => 'integer',
        'rating_value' => 'integer',
        'purchase_price_ngn' => 'decimal:2',
        'helpful_votes' => 'integer',
    ];

    public function perfume(): BelongsTo
    {
        return $this->belongsTo(Perfume::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
