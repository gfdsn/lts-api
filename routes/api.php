<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Support\Facades\Mail;
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

// TODO: remove
Route::get('/test-mail', function () {
    $user = UserModel::where("email", "campoozh@gmail.com")->get()->first();

    Mail::to($user->email)->send(new \App\Mail\ForgotPasswordEmail($user->email, Str::random(60)));

    return 'Sent';
});

/* Product CRUD routes */
Route::group(["prefix" => "product"], function () {
    Route::get("/", [ProductController::class, 'index']);
    Route::post("/", [ProductController::class, 'store']);
    Route::put('/', [ProductController::class, 'update']);
    Route::delete('/', [ProductController::class, 'delete']);
});

/* Categories CRUD routes */
Route::group(["prefix" => "category"], function () {
    Route::get("/", [CategoryController::class, 'index']);
});
