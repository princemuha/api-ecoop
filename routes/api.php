<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::prefix('v1')->group(function () {
// Utilities
Route::get('/keygen/{password}', function ($password) {
    return Hash::make($password);
});

// DB::enableQueryLog();
// dd(DB::getQueryLog());

// Auth
Route::post('login', [\App\Interface\Controllers\Auth\AuthController::class, 'login']);
Route::get('logout', [\App\Interface\Controllers\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [\App\Interface\Controllers\Auth\AuthController::class, 'register']);
Route::post('verify-otp', [\App\Interface\Controllers\Auth\AuthController::class, 'verifyOTP']);
Route::post('renew-otp', [\App\Interface\Controllers\Auth\AuthController::class, 'renewOTP']);

// Marketplace ------------------------------------------------------------
Route::middleware(['auth:sanctum', 'throttle:10,1'])->prefix('banner')->group(function () {
    Route::get('/', [\App\Interface\Controllers\Marketplace\Banner\BannerController::class, 'index']);
});
Route::middleware(['auth:sanctum', 'throttle:10,1'])->prefix('product-discount')->group(function () {
    Route::get('/', [\App\Interface\Controllers\Marketplace\Catalog\ProductController::class, 'index']);
});
// End of Marketplace ------------------------------------------------------

// Route::middleware(['auth:sanctum', 'throttle:60,1'])->prefix('banner')->group(function () {
//     Route::get('/', [\App\Interface\Controllers\Marketplace\Banner\BannerController::class, 'index']);
//     Route::get('/{id}', [\App\Interface\Controllers\Marketplace\Banner\BannerController::class, 'show']);
//     Route::post('/', [\App\Interface\Controllers\Marketplace\Banner\BannerController::class, 'store']);
//     Route::patch('/{id}', [\App\Interface\Controllers\Marketplace\Banner\BannerController::class, 'update']);
//     Route::delete('/{id}', [\App\Interface\Controllers\Marketplace\Banner\BannerController::class, 'delete']);
// });
// Route::get('/recommended', [\App\Interface\Controllers\Marketplace\Banner\BannerController::class, 'recommended'])->middleware('auth:sanctum', 'throttle:60,1');