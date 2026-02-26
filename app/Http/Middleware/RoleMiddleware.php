<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * This middleware checks if the authenticated user has the required role
     * to access a specific route. If the role doesn't match, it returns a 403 error.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string $role  The required role (e.g., 'admin' or 'employee')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is logged in and if their role matches the requirement
        if (! $request->user() || $request->user()->role !== $role) {
            // Block access with a 403 Forbidden response
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
