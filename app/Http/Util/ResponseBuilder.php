<?php

namespace App\Http\Util;

use App\Http\Resources\UserResource;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class ResponseBuilder
{
    public static function sendData(array|object $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode);
    }
    public static function success(string $message, int $statusCode = 200): JsonResponse
    {
        return response()->json(["status" => true, "message" => $message ], $statusCode);
    }
    public static function error(string $error, int $statusCode = 400): JsonResponse
    {
        return response()->json(["status" => false, "error" => $error], $statusCode);
    }
    public static function sendTokenAsCookie(UserResource $user, string $token, int $expirationMinutes = 30): JsonResponse
    {

        $cookie = Cookie::create(
            'token',
            $token,
            now()->addMinutes($expirationMinutes),
            '/',
            null, // TODO: change this at production
            env("APP_USING_HTTPS"),
            true,
            false,
            'Lax'
        );

        return response()->json([
            "status" => true,
            "user" => $user,
        ])->withCookie($cookie);

    }
    public static function sendLogoutTokenAsCookie(string $token, int $expirationMinutes = 30): JsonResponse
    {

        $cookie = Cookie::create(
            'token',
            $token,
            now()->addMinutes($expirationMinutes),
            '/',
            null, // TODO: change this at production
            env("APP_USING_HTTPS"),
            true,
            false,
            'Lax'
        );

        return response()->json([
            "status" => true,
        ])->withCookie($cookie);

    }
}
