<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAjaxController;
use App\Http\Controllers\ProfileAjaxController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    
    Route::post('/ajax/login', [AuthAjaxController::class, 'login'])->name('ajax.login');
    Route::post('/ajax/register', [AuthAjaxController::class, 'register'])->name('ajax.register');
    Route::post('/ajax/forgot-password', [AuthAjaxController::class, 'forgotPassword'])->name('ajax.forgot');
    Route::post('/ajax/reset-password', [AuthAjaxController::class, 'resetPassword'])->name('ajax.reset');
});

Route::middleware('auth')->group(function () {
    Route::post('/ajax/logout', [AuthAjaxController::class, 'logout'])->name('ajax.logout');
    Route::post('/ajax/profile', [ProfileAjaxController::class, 'update'])->name('ajax.profile.update');
    Route::post('/ajax/password', [ProfileAjaxController::class, 'changePassword'])->name('ajax.password.change');
    Route::post('/ajax/preferences', [ProfileAjaxController::class, 'savePreferences'])->name('ajax.preferences.save');

    // sample dashboard route (Blade view)
    Route::view('/dashboard', 'dashboard.index')->name('dashboard');
    Route::view('/dashboard/profile', 'dashboard.profile');
});

// sample public routes for auth pages (Blade views)
Route::view('/login', 'auth.login')->name('login');
Route::view('/signup', 'auth.signup')->name('signup');
Route::view('/forgot-password', 'auth.forgot')->name('password.request');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset', ['token' => $token]);
})->name('password.reset');
