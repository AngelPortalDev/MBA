<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SendLinkThrottle
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next, $maxAttempts = 2, $decayMinutes = 15)
    {
        $key = $this->resolveKey($request); // Implement your own key resolution based on email or other identifier

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return response()->view('frontend.too-many-request', [], 429); // Return the custom too many requests view
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        return $next($request);
    }

    protected function resolveKey(Request $request)
    {
        return $request->input('email'); // Or use another method to get the unique key
    }
}