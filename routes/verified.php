<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Verified-Only Routes (auth + verified)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard.index')->name('dashboard');
    Route::view('/dashboard/profile', 'dashboard.profile')->name('dashboard.profile');
});
