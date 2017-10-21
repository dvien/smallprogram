<?php

namespace App\Http\Middleware;


use Closure;
class checklogin
{

    public function handle($request, Closure $next)
    {
        echo 11;
        dd(session('username'));

        return $next($request);
    }
}
