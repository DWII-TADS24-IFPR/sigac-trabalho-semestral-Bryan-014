<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (Auth::check() && Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id')) {
            return redirect('/admin'); 
        }

        if (Auth::check() && Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id')) {
            return redirect('/aluno'); 
        }

        return $next($request);
    }
}
