<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InstituteApprovedMiddleware
{
    // public function handle(Request $request, Closure $next)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login')->with('error', 'Please log in first.');
    //     }

    //     // Get the authenticated user
    //     $user = Auth::user();
    //     $is_approved = DB::table('institute_profile_master')->where(['institute_id' => $user->id])->first()->is_approved;

    //     // Check if user has 'institute' role and is approved
    //     if ($user->role !== 'institute' || $is_approved == 0) {
    //         return redirect()->route('institute-pending-approval')->with('error', 'Your account is pending approval.');
    //     }

    //     return $next($request);
    // }
    
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user has an institute profile
        $instituteProfile = DB::table('institute_profile_master')
            ->where('institute_id', $user->id)
            ->first();

        if (!$instituteProfile) {
            return redirect()->route('login')->with('error', 'Institute profile not found.');
        }

        // Get approval status
        $is_approved = $instituteProfile->is_approved ?? 0;

        // If user role is not 'institute' or is_approved is 0, redirect to pending page
        if ($user->role !== 'institute' || $is_approved == 0) {
            return redirect()->route('institute-pending-approval')
                ->with('error', 'Your account is pending approval.');
        }

        // If is_approved == 2, restrict access to only specific routes
        // if ($is_approved == 2 && !in_array($request->route()->getName(), ['institute-profiles', 'institute-profile-update'])) {
        if (in_array($is_approved, [2, 4]) && !in_array($request->route()->getName(), ['institute-profiles', 'institute-profile-update'])) {

            return redirect()->route('institute-profiles')
                ->with('error', 'Your access is limited. Complete your profile update.');
        }

        return $next($request);
    }
}