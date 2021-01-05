<?php

namespace App\Http\Middleware;

use Closure;

class CheckForDestroyedSessions
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (cache()->has('logout_' . optional(user())->id)) {
            cache()->forget('logout_' . user()->id);
            \Auth::logout();
            \Session::flush();
            return redirect('/home');
        }
        return $next($request);
    }
}
