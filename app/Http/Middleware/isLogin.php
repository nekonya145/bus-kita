<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class isLogin
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
        if (!Session::has('firebase_user_id')) {
            // Jika tidak ada firebase_user_id di session, redirect ke halaman login
            return redirect()->route('/login')->withErrors(['auth' => 'Anda harus login untuk mengakses halaman ini.']);
        }

        return $next($request);
    }
}
