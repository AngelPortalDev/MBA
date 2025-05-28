<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use Carbon\Carbon;

class CheckSubEmentorDocumentation
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
        $role = Auth::user()->role;
        if($role === 'sub-instructor'){
            $subEmentorDocumentation = getData('subementor_documents', ['status'], ['sub_ementor_id' => Auth::user()->id]);
            $status = isset($subEmentorDocumentation[0]->status) ? $subEmentorDocumentation[0]->status : 0;
            if ($status === 1 && url()->current() === url('/sub-ementor/documentation')) {
                return redirect()->route('sub-e-mentor-profile');
            }
            
            if ($status === 0 || empty($subEmentorDocumentation)) {
                if (url()->current() !== url('/sub-ementor/documentation')) {
                    return redirect()->route('subementor-documentation');
                }
            }
            
        }
        return $next($request);
    }
}
