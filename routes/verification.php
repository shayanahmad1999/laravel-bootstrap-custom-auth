<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Email Verification Routes (require auth)
|--------------------------------------------------------------------------
*/

Route::get('/email/verify', fn() => view('auth.verify-email'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return to_route('dashboard'); // after verify
})
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    if ($request->expectsJson()) {
        return response()->json(['ok' => true, 'status' => 'verification-link-sent']);
    }
    return back()->with('status', 'verification-link-sent');
})
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
