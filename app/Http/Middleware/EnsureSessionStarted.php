<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;

class EnsureSessionStarted
{
    public function handle($request, Closure $next)
    {
        if (!Session::isStarted()) {
            Session::start();
        }

        return $next($request);
    }
}
