<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;


class ForceJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->header('Accept', 'application/json');
        return $response;
    }
}
