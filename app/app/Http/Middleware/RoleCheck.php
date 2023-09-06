<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role,$permission): Response
    {

        $user = auth()->user();

        if (!$user || !$user->hasRole($role) || !$user->hasPermissionTo($permission)) {
            abort(403); // Redirect or display an unauthorized error
        }

        return $next($request);
    }
}
