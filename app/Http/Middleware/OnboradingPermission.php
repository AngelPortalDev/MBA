<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class OnboradingPermission
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
        $permissionData = getData('permission', ['status','institute','student','ementor','teacher'],[],'','');
        foreach($permissionData as $data){
            $currentUrl = $request->url();
            if (str_contains($currentUrl, 'student-enrollment')) {
                if($data->student == "register" && $data->status == '0'){
                    return redirect()->route('not-found');
                }
            }
            if (str_contains($currentUrl, 'teacher-enrollment')) {
                if($data->teacher == "register" && $data->status == '0'){
                    return redirect()->route('not-found');
                }
            }
            if (str_contains($currentUrl, 'institute-enrollment')) {
                if($data->institute == "register" && $data->status == '0'){
                    return redirect()->route('not-found');
                }
            }
            $currentAction = Route::currentRouteAction();
            if ($currentAction === 'App\Http\Controllers\Auth\AuthenticatedSessionController@store') {
                $email = $request->input('email'); // Get the email from the request
                if ($email) {
                    $blockedOnboarding = blockedOnboarding($email); // Call the onboarding check function
                    if ($blockedOnboarding) {
                        return redirect()->back()->withErrors(['error' => $blockedOnboarding.' onboarding has been terminated.']);
                    }
                }
            }
        }
        return $next($request);
    }
}
