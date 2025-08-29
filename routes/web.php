<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthAjaxController;
use App\Http\Controllers\ProfileAjaxController;

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

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset', ['token' => $token]);
    })
        ->where('token', '[A-Za-z0-9._-]+')
        ->name('password.reset');

    // AJAX auth endpoints
    Route::prefix('ajax')->name('ajax.')->group(function () {
        // Reasonable throttling for brute-force protection
        Route::middleware('throttle:30,1')->group(function () {
            Route::post('/login', [AuthAjaxController::class, 'login'])->name('login');
            Route::post('/register', [AuthAjaxController::class, 'register'])->name('register');
            Route::post('/forgot-password', [AuthAjaxController::class, 'forgotPassword'])->name('forgot');
            Route::post('/reset-password', [AuthAjaxController::class, 'resetPassword'])->name('reset');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
| Keep these outside guest; they require auth.
*/
Route::get('/email/verify', fn() => view('auth.verify-email'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return to_route('dashboard');
})
    ->middleware(['auth', 'signed']) // signed = secure temporary signed URL
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    // Blade flow uses session flash; also return JSON for XHR callers.
    if ($request->expectsJson()) {
        return response()->json(['ok' => true, 'status' => 'verification-link-sent']);
    }

    return back()->with('status', 'verification-link-sent');
})
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (logged-in users)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthAjaxController::class, 'logout'])->name('logout');
    // AJAX (authenticated)
    Route::prefix('ajax')->name('ajax.')->group(function () {

        // Profile endpoints: throttle lightly; keep under auth
        Route::middleware('throttle:60,1')->group(function () {
            Route::post('/profile', [ProfileAjaxController::class, 'update'])->name('profile.update');
            Route::post('/password', [ProfileAjaxController::class, 'changePassword'])->name('password.change');
            Route::post('/preferences', [ProfileAjaxController::class, 'savePreferences'])->name('preferences.save');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Verified-Only Routes (require verified email)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Sample dashboard & profile (Blade views)
    Route::view('/dashboard', 'dashboard.index')->name('dashboard');
    Route::view('/dashboard/profile', 'dashboard.profile')->name('dashboard.profile');
});

/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    // Customize to your 404 page if you have one
    abort(404);
});
