<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/* Auth routes */
Route::post("/login", [AuthController::class, 'login'])->name('login');
Route::post("/logout", [AuthController::class, 'logout']); /* middleware in the controller */
Route::post("/register", [AuthController::class, 'register']);
Route::post("/forgot-password", [AuthController::class, 'forgotPassword']);
Route::post("/reset-password", [AuthController::class, 'resetPassword']);

/* User CRUD routes */
Route::group([
    "prefix" => 'user',
], function () {
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'delete']);
    Route::get('/', [UserController::class, 'index']);
});


Route::get('/test-mail', function () {
    $user = \App\Infrastructure\Persistence\User\Models\UserModel::where("email", "campoozh@gmail.com")->get()->first();

    \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\ForgotPasswordEmail($user->email, Str::random(60)));
    return 'Sent';
});

