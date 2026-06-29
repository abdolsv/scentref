<?php
// app/Http/Controllers/ContactController.php
namespace App\Http\Controllers;

use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{Mail, RateLimiter};

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request): JsonResponse
    {
        // Per-IP rate limit: 3 submissions per hour
        $key = 'contact:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'message' => "Too many submissions. Please try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 3600);

        $validated = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:200',
            'subject' => 'required|in:price_correction,suggest_perfume,fake_alert,general,partnership',
            'message' => 'required|string|min:20|max:2000',
        ]);

        $subjectLabels = [
            'price_correction' => 'Price Correction',
            'suggest_perfume'  => 'Suggest a Perfume',
            'fake_alert'       => 'Fake Alert',
            'general'          => 'General Enquiry',
            'partnership'      => 'Partnership / Advertising',
        ];

        // Send notification email to admin
        Mail::raw(
            "From: {$validated['name']} <{$validated['email']}>\n"
            . "Subject: {$subjectLabels[$validated['subject']]}\n\n"
            . $validated['message'],
            function ($m) use ($validated, $subjectLabels) {
                $m->to('hello@scentref.ng')
                  ->replyTo($validated['email'], $validated['name'])
                  ->subject('[ScentRef Contact] ' . $subjectLabels[$validated['subject']]);
            }
        );

        return response()->json(['message' => 'Received. Thank you!'], 200);
    }
}
