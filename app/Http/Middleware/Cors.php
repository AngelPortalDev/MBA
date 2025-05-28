<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    // public function handle(Request $request, Closure $next)
    // {
    //     $headers = [
    //         'Access-Control-Allow-Origin' => '*',
    //         'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
    //         'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With, x-xsrf-token', // Add x-xsrf-token here
    //     ];

    //     if ($request->isMethod('OPTIONS')) {
    //         return response()->json('OK', 200, $headers);
    //     }

    //     $response = $next($request);
    //     foreach ($headers as $key => $value) {
            
    //         $response->header($key, $value);
    //         $response->headers->set();
    //     }

    //     return $response;
    // }

    public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        ];
    
        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }
    
        $response = $next($request);
        foreach($headers as $key => $value) {
            // $response->header($key, $value);
            $response->headers->set($key, $value);

        }
    
        return $response;
    }    
}
