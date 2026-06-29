<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriceAlertRequest;
use App\Models\Perfume;
use App\Models\PriceAlert;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PriceAlertController extends Controller
{
    /**
     * Store or update a customer subscription target for price drops.
     */
    public function store(StorePriceAlertRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $perfume = Perfume::findOrFail($validated['perfume_id']);

        PriceAlert::updateOrCreate(
            [
                'perfume_id' => $perfume->id, 
                'email' => $validated['email']
            ],
            [
                'target_price_ngn' => $validated['target_price'],
                'unsubscribe_token' => Str::random(64),
                'is_active' => true,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => "Price alert set! We'll email you when the price drops.",
        ]);
    }

    /**
     * Turn off subscription monitoring for a given customer token identifier.
     */
    public function unsubscribe(string $token): View
    {
        PriceAlert::where('unsubscribe_token', $token)->update(['is_active' => false]);

        return view('price-alerts.unsubscribed');
    }
}
