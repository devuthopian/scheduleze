<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BackendAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
	public function handle($request, Closure $next)
	{
	    if (!empty(session('authenticated'))) {
	        $request->session()->put('authenticated', time());
	        return $next($request);
	    }

	    return redirect('/backend');
	}
}