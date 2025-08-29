<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    abort(404);
});

Route::get('/500', function () {
    abort(500);
});

Route::get('/admin', function () {
    abort(403);
});

Route::get('/user', function () {
    abort(401);
});
