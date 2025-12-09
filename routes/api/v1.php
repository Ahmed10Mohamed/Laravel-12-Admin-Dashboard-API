<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;

Route::prefix('v1')->group(function () {

    Route::middleware(['APISettings', 'throttle:global'])->group(function () {
        Route::get('rate-limit-endpoint', function () {
            return response()->json(['message' => 'This is a rate-limited endpoint.']);
        })->middleware('throttle:5,1'); // Limit to 5 requests per minute

        // Auth routes
        Route::prefix('auth')->group(function () {
            Route::post('register', [AuthController::class, 'register'])->name('api.register')->middleware('throttle:register');
            Route::post('login', [AuthController::class, 'login'])->name('api.login')->middleware('throttle:login');
        });

        // Protected routes
        Route::middleware(['auth:api'])->prefix('auth/profile')->group(function () {
            Route::get('/', [AuthController::class, 'show_profile']);
            Route::post('update', [AuthController::class, 'update_profile']);
            Route::post('fcmToken', [AuthController::class, 'update_fcm']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('destroy', [AuthController::class, 'destroy']);
        });

    });

});

