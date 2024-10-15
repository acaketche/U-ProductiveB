<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {

        Log::info('Role Middleware', [
            'user_id' => Auth::id(),
            'role' => Auth::check() ? Auth::user()->role : 'Guest',
            'expected_role' => $role,
        ]);
        // Cek apakah pengguna terautentikasi dan memiliki peran yang sesuai
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // Jika tidak, redirect atau berikan respons sesuai kebutuhan
        return redirect('/'); // Misalnya redirect ke homepage


    }


}

