<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleDosen
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
        if ($request->user()->role !== 'dosen' ) {
            return abort(503, 'Dosen Page !! Anda tidak memiliki hak akses');
        }
        return $next($request);
    }
}
