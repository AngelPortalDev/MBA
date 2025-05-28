<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddXFrameOptionsHeader
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
        // Add the X-Frame-Options header
        $response = $next($request);
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        return $response;
    }
}
