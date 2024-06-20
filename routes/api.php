<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [UserController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('admin/users', UserController::class)
        ->only(['store', 'update', 'destroy'])
        ->middleware('role:admin');

    Route::apiResource('manager/products', ProductController::class)
        ->only(['store', 'update', 'destroy'])
        ->middleware('role:manager');

    Route::apiResource('seller/orders', OrderController::class)
        ->only(['store', 'update', 'destroy'])
        ->middleware('role:seller');

    Route::apiResource('customer/products', ProductController::class)
        ->only(['index'])
        ->middleware('role:customer');

    Route::apiResource('customer/orders', OrderController::class)
        ->only(['index'])
        ->middleware('role:customer');
});
