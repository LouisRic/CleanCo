<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('verification.*')) {
            return $next($request);
        }
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'customer') {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
