<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("/login", [AuthController::class, 'login']);
Route::post("/logout", [AuthController::class, 'logout']);
Route::post("/register", [AuthController::class, 'register']);

Route::group([
    "prefix" => 'user',
], function () {
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'delete']);
    Route::get('/', [UserController::class, 'index']);
});

/*
Route::get('/test-mail', function () {
    $user = \App\Infrastructure\Persistence\User\Models\UserModel::where("email", "campoozh@gmail.com")->get()->first();

    \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\IndividualWelcomeEmail($user));
    return 'Sent';
});
*/
