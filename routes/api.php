<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post("/login", [AuthController::class, 'login']);

Route::group([
    "prefix" => 'user'
], function () {
    Route::apiResource('/', UserController::class)->only(['index', 'store']);
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'delete']);
});
