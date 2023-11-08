<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Divisi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$divisi)
    {
        $user = Auth::user();
        $allowedDivisions = ['DKM', 'KKW', 'BMM', 'Zakat'];

        // if (Auth::check() && Auth::user()->divisi == 'DKM') {
        //     // Pengguna memiliki peran yang diperlukan
        //     // Anda dapat mengakses $user di sini jika diperlukan
        //     return $next($request);
        // }else if (Auth::check() && Auth::user()->divisi == 'BMM') {
        //     // Pengguna memiliki peran yang diperlukan
        //     // Anda dapat mengakses $user di sini jika diperlukan
        //     return $next($request);
        // }else if (Auth::check() && Auth::user()->divisi == 'KKW') {
        //     // Pengguna memiliki peran yang diperlukan
        //     // Anda dapat mengakses $user di sini jika diperlukan
        //     return $next($request);
        // }else if (Auth::check() && Auth::user()->divisi == 'Zakat') {
        //     // Pengguna memiliki peran yang diperlukan
        //     // Anda dapat mengakses $user di sini jika diperlukan
        //     return $next($request);
        // }
        // if (Auth::check() && Auth::user()->divisi == $divisi) {
        if (Auth::check() && in_array(Auth::user()->divisi, $allowedDivisions)) {
            // Pengguna memiliki peran yang diperlukan
            // Anda dapat mengakses $user di sini jika diperlukan
            return $next($request);
        }

        // Tindakan jika pengguna tidak memiliki peran yang diperlukan
        // return redirect('/');
        // abort(403, 'Akses Ditolak');
        return response()->json(['You do not have permission to access for this page.']);
    }
}
