<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has the "admin" role
        if ($request->user() && $request->user()->role_id === 1) {
            return $next($request);
        }

        // If not an admin, return 403 Forbidden response
        return response()->json(['message' => 'Unauthorized'], 403);
    }
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if ($request->user() && $request->user()->isAdmin()) {
    //         return $next($request);
    //     }

    //     return response()->json(['message' => 'Unauthorized'], 403);
    // }
}
