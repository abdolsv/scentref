<?php

namespace App\Services;

use App\Jobs\SendReviewVerificationEmail;
use App\Models\{Perfume, Review, User};
use Illuminate\Support\Str;

class ReviewService
{
    public function submit(Perfume $perfume, array $data): Review
    {
        $review = Review::create([
            "perfume_id"        => $perfume->id,
            "reviewer_name"     => $data["reviewer_name"],
            "reviewer_email"    => $data["reviewer_email"] ?? null,
            "reviewer_city"     => $data["reviewer_city"] ?? null,
            "reviewer_climate"  => $data["reviewer_climate"] ?? "hot_outdoor",
            "rating_overall"    => $data["rating_overall"],
            "rating_longevity"  => $data["rating_longevity"] ?? null,
            "rating_sillage"    => $data["rating_sillage"] ?? null,
            "rating_value"      => $data["rating_value"] ?? null,
            "purchase_source"   => $data["purchase_source"] ?? null,
            "purchase_price_ngn"=> $data["purchase_price_ngn"] ?? null,
            "review_title"      => $data["review_title"] ?? null,
            "review_body"       => $data["review_body"],
            "status"            => $data["reviewer_email"] ? "pending" : "pending",
            "verification_token"=> $data["reviewer_email"] ? Str::random(64) : null,
        ]);

        if ($review->reviewer_email && $review->verification_token) {
            SendReviewVerificationEmail::dispatch($review)->onQueue("notifications");
        }
        return $review;
    }

    public function verify(string $token): bool
    {
        $review = Review::where("verification_token", $token)
                        ->whereNull("email_verified_at")
                        ->first();
        if (!$review) return false;

        $review->update(["email_verified_at" => now()]);
        return true;
    }

    public function approve(Review $review, User $admin): void
    {
        $review->update([
            "status"      => "approved",
            "approved_at" => now(),
            "approved_by" => $admin->id,
        ]);
    }

    public function reject(Review $review): void
    {
        $review->update(["status" => "rejected"]);
    }
}

