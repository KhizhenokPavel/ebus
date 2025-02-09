<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header(env('API_KEY_HEADER_NAME'));

        if ($apiKey && $apiKey == env('API_KEY')) {
            return $next($request);
        }

        return response()->json(['error' => __('errors.unauthorized')], 401);
    }
}
