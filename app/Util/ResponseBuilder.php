<?php

namespace App\Util;

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

    public static function error(array $errors, int $statusCode = 400): JsonResponse
    {
        return response()->json(["status" => false, $errors], $statusCode);
    }
}
