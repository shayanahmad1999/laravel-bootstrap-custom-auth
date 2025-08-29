<?php

use App\Http\Controllers\AuthAjaxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes (unauthenticated only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Landing
    Route::view('/', 'welcome')->name('home');

    // Public auth pages (Blade)
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/signup', 'auth.signup')->name('signup');
    Route::view('/forgot-password', 'auth.forgot')->name('password.request');

    // Reset password view (token guard for cleanliness)
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset', ['token' => $token]);
    })
        ->where('token', '[A-Za-z0-9._-]+')
        ->name('password.reset');

    // Guest AJAX endpoints (throttled)
    Route::prefix('ajax')->name('ajax.')->middleware('throttle:30,1')->group(function () {
        Route::post('/login',    [AuthAjaxController::class, 'login'])->name('login');
        Route::post('/register', [AuthAjaxController::class, 'register'])->name('register');
        Route::post('/forgot-password', [AuthAjaxController::class, 'forgotPassword'])->name('forgot');
        Route::post('/reset-password',  [AuthAjaxController::class, 'resetPassword'])->name('reset');
    });
});
