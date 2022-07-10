<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roleUser = Auth::user()->role;
        if ($roleUser == 'guru') {
            $roleInEng = 'teacher';
        } elseif ($roleUser == 'siswa') {
            $roleInEng = 'student';
        } else {
            $roleInEng = 'admin';
        }
        if ($role == $roleUser) {
            return $next($request);
        } else {
            return redirect()->route("$roleInEng.dashboard");
        }
    }
}
