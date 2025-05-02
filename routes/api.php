<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::apiResource('user', UserController::class)
    ->only(['index', 'store'])->withoutMiddleware('auth:sanctum');
