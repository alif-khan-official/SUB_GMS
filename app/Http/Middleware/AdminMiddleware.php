<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return $next($request);
            } elseif (Auth::user()->role == 'Super Admin') {
                return redirect('admins/super/admin');
            } elseif (Auth::user()->role == 'Teacher') {
                return redirect('admins/teacher/my-course');
            }
        }
        else{
            return redirect('login');
        }
    }
}
