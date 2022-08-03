<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!Auth::user() or !Auth::user()->hasRoles(['admin'])) {
            return redirect()->route('login')/*->withErrors(['error' => 'data dose not exists'])*/;
        }
        return $next($request);


    }

}
