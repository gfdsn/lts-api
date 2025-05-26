<?php

namespace App\Http\Middleware;

use App\Domain\User\Enums\UserProfileType;
use App\Util\ResponseBuilder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserIdentity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* should already have passed the auth:api middleware */
        $user = auth()->user();
        $requestId = $request->route('id') ?? $request->route('user') ?? $request->get('id');

        /* user is itself or user is an admin */
        if ($user->profileType->name == UserProfileType::ADMIN->value || $user->id == $requestId) {
            return $next($request);
        }

        return ResponseBuilder::error("Forbidden", 403);

    }
}
