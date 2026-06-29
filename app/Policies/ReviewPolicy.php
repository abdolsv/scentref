<?php

namespace App\Policies;

use App\Models\{Review, User};

class ReviewPolicy
{
    public function approve(User $user, Review $review): bool
    { return $user->is_admin; }

    public function reject(User $user, Review $review): bool
    { return $user->is_admin; }

    public function delete(User $user, Review $review): bool
    { return $user->is_admin || $user->id === $review->user_id; }
}

