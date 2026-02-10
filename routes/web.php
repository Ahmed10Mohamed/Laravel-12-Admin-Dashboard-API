<?php

use App\Http\Controllers\Admin\Auth\authController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\profileController;
use App\Http\Controllers\Admin\AboutSectionController;




Route::group(['middleware' => 'admin.guest'], function () {

    Route::get('/', [authController::class, 'showLoginForm'])->name('login')->middleware('admin');
});
Route::post('/login', [AuthController::class, 'login'])->name('admin.login')->middleware('admin');
Route::get("logout", [AuthController::class, "logout"])
    ->name('admin_logout')
    ->withoutMiddleware('admin.guest')
    ->middleware("auth:admin");
Route::group(["prefix" => "/Dashboard-Admin"],function (){
    Route::get('500', function () {
        abort(500); // This will trigger a 500 error
    })->name('Error-500');
    Route::get('404', function () {
        return view('errors.404'); // Create a Blade file at resources/views/errors/404.blade.php
    })->name('Error-404');
    Route::get('403', function () {
        return view('errors.403'); // Create a Blade file at resources/views/errors/403.blade.php
    })->name('Error-403');

    Route::group(['middleware' => ['auth:admin','active']], function () {

        /*Dashboard */
        Route::get('/' , DashboardController::class)->name('Admin-Dashboard');
               /* About Section */
        Route::get('About-{position}', [AboutSectionController::class, 'edit'])->name('AboutSection.edit');
        Route::post('About-Section', [AboutSectionController::class, 'update'])->name('AboutSection.update');

        /*profile */
        Route::group(["prefix" => "Profile"],function (){
            Route::get("/",[profileController::class,"show"])->name('Profile');
            Route::post("/Update",[profileController::class,"update"])->name('Profile.Update');

            Route::get("/Password",[profileController::class,"password"])->name('Profile.Password');
            Route::post("/Update-Password",[profileController::class,"update_password"])->name('Profile.UpdatePassword');

        });
    });
    });
