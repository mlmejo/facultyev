<?php

use App\Http\Controllers\SectionRatingController;
use App\Http\Controllers\StudentRatingController;
use App\Http\Controllers\UserDashboardController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/register/admin')
    ->middleware('guest');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(RouteServiceProvider::HOME);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/dashboard', UserDashboardController::class)
    ->middleware('auth')
    ->name('dashboard');

Route::resource('sections.ratings', SectionRatingController::class)
    ->middleware('auth');

Route::resource('students.ratings', StudentRatingController::class)
    ->middleware('auth');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
