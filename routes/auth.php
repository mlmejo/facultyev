<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredAdminUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register/admin', [RegisteredAdminUserController::class, 'create'])
        ->middleware('check.admin')
        ->name('register.admin');

    Route::post('/register/admin', [RegisteredAdminUserController::class, 'store'])
        ->middleware('check.admin');
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
