<?php

namespace App\Http\Middleware;

use Closure;

class TestAdmin
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
