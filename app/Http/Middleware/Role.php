<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \
     * \Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        $role_name = $request->user()->role;
        // return   
        // $roles = explode('|',$role);

        if ($role_name === 'user' && $role !== 'user') {
            return redirect('student/dashboard');
        } elseif ($role_name === 'instructor' && $role !== 'instructor') {
            return redirect('ementor/e-mentor-dashboard');
        } elseif ($role_name === 'institute' && $role !== 'institute') {
            return redirect('/institute/dashboard');
        } else if ($role_name === 'admin' && $role !== 'admin')  {
            return redirect('/admin/dashboard');
        } else if ($role_name === 'superadmin' && !in_array($role, ['admin','superadmin','sales'])) {
            return redirect('/admin/dashboard');
        } else if ($role_name === 'sales' && !in_array($role, ['admin','superadmin','sales'])) {
            return redirect('/admin/dashboard');
        }
        return $next($request);
    }
}