<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::prefix('v1')->group(function () {
// Utilities
Route::get('/keygen/{password}', function ($password) {
    return Hash::make($password);
});

// DB::enableQueryLog();
// dd(DB::getQueryLog());

// Auth
Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);

// Administration - user management
Route::middleware(['auth:sanctum', 'throttle:60,1'])->prefix('users')->group(function () {
    Route::get('/', [\App\Http\Controllers\Users\UserController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\Users\UserController::class, 'show']);
    Route::post('/', [\App\Http\Controllers\Users\UserController::class, 'store']);
    Route::patch('/{id}', [\App\Http\Controllers\Users\UserController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\Users\UserController::class, 'delete']);
});

// Master - products
// Route::get('products', [\App\Domain\Master\Controllers\ProductController::class, 'index']);
// Route::get('products/{id}', [\App\Domain\Master\Controllers\ProductController::class, 'show']);

// Transaction - orders (example protected)
// Route::middleware('auth:sanctum')->prefix('orders')->group(function () {
//     Route::post('/', [\App\Domain\Transaction\Controllers\OrderController::class, 'store']);
//     Route::get('{id}', [\App\Domain\Transaction\Controllers\OrderController::class, 'show']);
// });
// });