<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if (Auth::user()->role == 'Super Admin') {
                return redirect('admins/super/admin');
            } elseif (Auth::user()->role == 'Admin') {
                return redirect('admins/admin/all-course');
            } elseif (Auth::user()->role == 'Teacher') {
                return redirect('admins/teacher/my-course');
            }
        }
        else{
            return $next($request);
        }
    }
}
