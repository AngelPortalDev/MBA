<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectToLoginOrSignupWithSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            if(url()->current() == env('APP_URL').'/course/addtocart'){
                session([
                    'intended_url' => url()->current(),
                    'intended_action_cart'=> $request->all()
                ]);
                session()->forget('form_data'); // Clear the session after use
                session()->forget('intended_action_wishlist'); // Clear the session after use

            }else if(url()->current() == env('APP_URL').'/student/addwishlist'){
                session([
                    'intended_url' => url()->current(),
                    'intended_action_wishlist'=> $request->all(),
                    'intended_action_cart'=>'',
                ]);
                session()->forget('form_data'); // Clear the session after use
                session()->forget('intended_action_cart'); // Clear the session after use
            }else if(url()->current() == env('APP_URL').'/checkout'){
                session([
                    'intended_url' => url()->current(),
                    'form_data' => $request->all(), // Store the entire form data or specific fields
                ]);
                session()->forget('intended_action_cart'); // Clear the session after use
                session()->forget('intended_action_wishlist'); // Clear the session after use
            }
    
            // Redirect to login or signup page
            return redirect()->route('login')->with('message', 'Please log in or sign up to continue to checkout.');
        }
        return $next($request);
    }
}
