<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Active
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

            if (!admin()->isActive ) {
                Auth::guard('admin')->logout();
                return redirect()->route('login')->with('fail',"هذا الحساب معطل");

            }

        return $next($request);
    }
}
