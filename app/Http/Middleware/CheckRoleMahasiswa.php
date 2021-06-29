<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleMahasiswa
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
        if ($request->user()->role !== 'mahasiswa' ) {
            return abort(503, 'Mahasiswa Page !! Anda tidak memiliki hak akses');
        }
        return $next($request);
    }
}
