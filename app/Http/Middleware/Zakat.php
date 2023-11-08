<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Zakat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = Auth::user();

        if (Auth::check() && Auth::user()->divisi == 'Zakat') {
            // Pengguna memiliki peran yang diperlukan
            // Anda dapat mengakses $user di sini jika diperlukan
            return $next($request);
        }

        // Tindakan jika pengguna tidak memiliki peran yang diperlukan
        // return redirect('/');
    }
}
