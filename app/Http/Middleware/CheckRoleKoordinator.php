<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleKoordinator
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
        if ($request->user()->role !== 'koordinator' ) {
            return abort(503, 'Koordinator Page !! Anda tidak memiliki hak akses');
        }
        return $next($request);
    }
}
