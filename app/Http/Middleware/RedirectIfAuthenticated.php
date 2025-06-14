<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::check() && Auth::user()->role === 'user') {
                    return redirect('student/dashboard');
                } elseif (Auth::check() && Auth::user()->role === 'instructor') {
                    return redirect('instructor/dashboard');
                } elseif (Auth::check() && Auth::user()->role === 'institute') {
                    return redirect('institute/dashboard');
                } elseif (Auth::check() && Auth::user()->role === 'admin') {
                    return redirect('admin/admin');
                } elseif (Auth::check() && Auth::user()->role === 'superadmin') {
                    return redirect('admin/admin');
                } elseif (Auth::check() && Auth::user()->role === 'sales') {
                    return redirect('admin/admin');
                }

                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }

    
}