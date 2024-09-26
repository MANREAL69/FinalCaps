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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated and if the role matches
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Redirect or abort with a 403 Unauthorized response
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

