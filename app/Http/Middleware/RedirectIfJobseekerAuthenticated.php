<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfJobseekerAuthenticated
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
        //If request comes from logged in user, he will
        //be redirect to home page.
        if (Auth::guard()->check()) {
            return redirect('/');
        }

        //If request comes from logged in jobseeker, he will
        //be redirected to jobseeker's home page.
        if (Auth::guard('jobseeker')->check()) {
            return redirect('/finde_influencer_test');
        }
        return $next($request);
    }
}
