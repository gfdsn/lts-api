<?php

namespace App\Http\Util;

use Illuminate\Http\JsonResponse;

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
    public static function sendTokenAsCookie(string $message, string $token, int $expirationMinutes = 30): JsonResponse
    {
        return response()->json(["status" => true, "message" => $message])
            ->withCookie('token', $token, $expirationMinutes, null, null, env("APP_USING_HTTPS"), true);
    }
}
