<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $maxAge = '3600'): Response
    {
        $response = $next($request);

        // Only apply optimization headers to successful standard GET requests
        if ($response->status() === 200 && $request->isMethod('GET')) {
            $response->headers->set('Cache-Control', "public, max-age={$maxAge}, must-revalidate");
            $response->headers->set('Vary', 'Accept-Encoding, Cookie');
        }

        return $response;
    }
}
