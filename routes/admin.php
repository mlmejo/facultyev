<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::resource('courses', CourseController::class)
        ->except('show');

    Route::resource('programs', ProgramController::class)
        ->except('show');

    Route::resource('students', StudentController::class)
        ->except('show');

    Route::resource('instructors', InstructorController::class)
        ->except('show');
});
