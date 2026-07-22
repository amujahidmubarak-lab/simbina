<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->status !== 'approved') {
            if ($request->routeIs('approval.notice') || $request->routeIs('logout')) {
                return $next($request);
            }
            return redirect()->route('approval.notice');
        }

        return $next($request);
    }
}
