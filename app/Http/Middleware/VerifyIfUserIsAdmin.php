<?php

namespace App\Http\Middleware;

use App\Http\Util\ResponseBuilder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyIfUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        /* verify if user is admin */
        return !$user->is_admin ? ResponseBuilder::error("Forbidden", 403) : $next($request);

    }
}
