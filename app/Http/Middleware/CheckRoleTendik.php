<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleTendik
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
        if ($request->user()->role !== 'tendik' ) {
            return abort(503, 'Tendik Page !! Anda tidak memiliki hak akses');
        }
        return $next($request);
    }
}
