<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param string $roleName
     * @return mixed
     */
    public function handle($request, Closure $next, string $roleName)
    {
        abort_if(! Auth::check(), 401);
        if (! Auth::user()->checkRole('admin')) {
            abort_if(! Auth::user()->roles->contains('name', $roleName), 403);
        }
        return $next($request);
    }
}
