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
    public function handle(Request $request, Closure $next, ...$roles)
{
    Log::info('Role Middleware', [
        'user_id' => Auth::id(),
        'role' => Auth::check() ? Auth::user()->role : 'Guest',
        'expected_roles' => $roles,
    ]);

    if (Auth::check() && in_array(Auth::user()->role, $roles)) {
        return $next($request);
    }

    return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}
}
