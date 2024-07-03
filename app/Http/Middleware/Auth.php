<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = \Illuminate\Support\Facades\Auth::check();

        // If user is authenticated and trying to access login or register page, redirect to home
        if ($user && ($request->route()->getName() === 'login' || $request->route()->getName() === 'register')) {
            return redirect('/');
        }

        // If user is not authenticated and trying to access other protected pages, redirect to login
        if (!$user && !in_array($request->route()->getName(), ['login', 'register'])) {
            return redirect('/login');
        }

        return $next($request);
    }
}
