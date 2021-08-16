<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class IsAdminMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_admin !== 1){
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
