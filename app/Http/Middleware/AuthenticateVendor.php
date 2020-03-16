<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateVendor
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
        if(!\Auth::guard('vendor')->user()) {
            return redirect('/')->with('error', 'Access Denied');
        }
        return $next($request);
    }
}
