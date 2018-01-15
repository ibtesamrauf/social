<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class AuthenticateJobseeker
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
        //If request does not comes from logged in jobseeker
       //then he shall be redirected to Jobseeker Login page
        if (! Auth::guard('jobseeker')->check()) {
           return redirect('/jobseeker_login')->with('login_modal',TRUE);
        }
        
        return $next($request);
    }
}
