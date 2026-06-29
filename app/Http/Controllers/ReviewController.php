<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Perfume;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function __construct(
        private readonly ReviewService $reviewService
    ) {}

    /**
     * Store a newly created review in storage.
     */
    public function store(StoreReviewRequest $request, string $slug): JsonResponse
    {
        $perfume = Perfume::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $review = $this->reviewService->submit($perfume, $request->validated());

        return response()->json([
            'success' => true,
            'message' => $review->reviewer_email
                ? 'Review submitted! Check your email to verify and publish it.'
                : 'Review submitted for moderation. Thank you!',
        ]);
    }

    /**
     * Verify the review using a unique verification token.
     */
    public function verify(string $token): View
    {
        $success = $this->reviewService->verify($token);
        
        return view('reviews.verify-result', compact('success'));
    }
}
