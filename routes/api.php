<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/* Auth routes */
Route::post("/login", [AuthController::class, 'login'])->name('login');
Route::post("/logout", [AuthController::class, 'logout']); /* middleware in the controller */
Route::post("/register", [AuthController::class, 'register']);
Route::post("/forgot-password", [AuthController::class, 'forgotPassword']);
Route::post("/reset-password", [AuthController::class, 'resetPassword']);
Route::post("/me", [AuthController::class, 'me']);

/* User CRUD routes */
Route::group(["prefix" => 'user',], function () {
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'delete']);
    Route::get('/', [UserController::class, 'index']);
});

// TODO: remove
Route::get('/test-wishlist', function () {
    $user = auth()->user();

    return \App\Http\Resources\ProductResource::collection($user->wishlist);
});

/* Product CRUD routes */
Route::group(["prefix" => "product"], function () {
    Route::get("/", [ProductController::class, 'index']);
    Route::post("/", [ProductController::class, 'store']);
    Route::put('/', [ProductController::class, 'update']);
    Route::delete('/', [ProductController::class, 'delete']);
    Route::post('/show', [ProductController::class, 'show']); // id in the request for validation
    Route::post("/randomProductCount", [ProductController::class, 'randomProductCount']);
});

/* Categories CRUD routes */
Route::group(["prefix" => "category"], function () {
    Route::get("/", [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put("/", [CategoryController::class, 'update']);
    Route::delete('/', [CategoryController::class, 'delete']);
    Route::post("/randomCategoryCount", [CategoryController::class, 'randomCategoryCount']);
});

/* Product Accessories CRUD routes */
Route::group(["prefix" => "accessory"], function () {
    Route::get("/", [AccessoryController::class, 'index']);
    Route::post("/", [AccessoryController::class, 'store']);
    Route::put("/", [AccessoryController::class, 'update']);
    Route::delete("/", [AccessoryController::class, 'delete']);
});

/* Wishlist routes */
Route::group(["prefix" => "wishlist"], function () {
    Route::post("/get", [WishlistController::class, 'getUserWishlist']);
    Route::post("/add", [WishlistController::class, 'addProductToWishlist']);
    Route::post("/remove", [WishlistController::class, 'removeProductToWishlist']);
});

/* Cart routes */
Route::group(["prefix" => "cart"], function () {
    Route::post("/get", [CartController::class, 'getUserCart']);
    Route::post("/add", [CartController::class, 'addToCart']);
    Route::post("/remove", [CartController::class, 'removeFromCart']);
    Route::post("/clear", [CartController::class, 'clearCart']);
});
