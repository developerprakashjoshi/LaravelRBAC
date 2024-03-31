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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role,$permission=null)
    {
        // Check if user is authenticated
        if (!$request->user()) {
            abort(401, 'Unauthenticated');
        }

        // Check user role
        if (!$request->user()->hasRole($role)) {
            abort(403, 'Unauthorized');
        }

        // Check user permission
        if ($permission !== null && !$request->user()->can($permission)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
