<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\RatingResultController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionRatingController;
use App\Http\Controllers\SectionStudentController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SetCurrentSemesterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UploadedCsvController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::resource('semesters', SemesterController::class)
        ->except('show');

    Route::post('/semesters/{semester}/c', SetCurrentSemesterController::class)
        ->name('semester.c');

    Route::resource('courses', CourseController::class)
        ->except('show');

    Route::resource('programs', ProgramController::class)
        ->except('show');

    Route::resource('subjects', SubjectController::class)
        ->except('show');

    Route::resource('students', StudentController::class)
        ->except('show');

    Route::resource('instructors', InstructorController::class)
        ->except('show');

    Route::resource('sections', SectionController::class)
        ->except('show');

    Route::resource('sections.students', SectionStudentController::class)
        ->except('show');

    Route::resource('questionnaires', QuestionnaireController::class);

    Route::get('/sections/{section}/ratings', [SectionRatingController::class, 'index'])
        ->name('sections.ratings.index');

    Route::get('/results', [RatingResultController::class, 'index'])
        ->name('results.index');

    Route::get('/students/{student}/ratings/print', [RatingResultController::class, 'print'])
        ->name('results.print');

    Route::controller(UploadedCsvController::class)->group(function () {
        Route::post('/courses/import', 'courseUpload')
            ->name('courses.import');

        Route::post('/programs/import', 'programUpload')
            ->name('programs.import');

        Route::post('/subjects/import', 'subjectUpload')
            ->name('subjects.import');

        Route::post('/instructors/import', 'instructorUpload')
            ->name('instructors.import');

        Route::post('/students/import', 'studentUpload')
            ->name('students.import');

        Route::post('/sections/import', 'sectionUpload')
            ->name('sections.import');
    });
});
