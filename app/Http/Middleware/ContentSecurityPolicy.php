<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Define the CSP policy as a single line, no new lines or line breaks
        // $cspPolicy = "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'; frame-ancestors 'self';";
        $cspPolicy = "default-src 'self';";

        // Get the response
        $response = $next($request);

        // Add the CSP header to the response
        $response->headers->set('Content-Security-Policy', $cspPolicy);

        return $response;
    }
}