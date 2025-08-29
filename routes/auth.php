<?php

use App\Http\Controllers\AuthAjaxController;
use App\Http\Controllers\ProfileAjaxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authenticated Routes (logged-in users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Standard logout alias (fixes "Route [logout] not defined")
    Route::post('/logout', [AuthAjaxController::class, 'logout'])->name('logout');

    // AJAX for authenticated users
    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::post('/logout', [AuthAjaxController::class, 'logout'])->name('logout');

        // Profile endpoints (light throttle)
        Route::middleware('throttle:60,1')->group(function () {
            Route::post('/profile',     [ProfileAjaxController::class, 'update'])->name('profile.update');
            Route::post('/password',    [ProfileAjaxController::class, 'changePassword'])->name('password.change');
            Route::post('/preferences', [ProfileAjaxController::class, 'savePreferences'])->name('preferences.save');
        });
    });
});
