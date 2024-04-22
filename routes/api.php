<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestAPI\Admin;
use App\Http\Controllers\RestAPI\Exam;
use App\Http\Controllers\RestAPI\Patient;
use App\Http\Controllers\RestAPI\PersonalInformationController;
use App\Http\Controllers\RestAPI\Question;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/

Route::prefix('api')->group(function () {
    Route::prefix('question')->group(function () {
        Route::get('/{id}', [Question::class, 'show'])->name('show_question');
        Route::post('/question', [Question::class, 'store'])->name('store_question');
    });

    Route::prefix('exam')->group(function () {
        // Admin
        Route::get('/delete', [Exam::class, 'delete'])->name('delete_exam');
        Route::post('/approve', [Exam::class, 'approve'])->name('approve_exam');
        Route::post('/add', [Exam::class, 'add'])->name('add_exam');

        // Patient
        Route::get('/start', [Exam::class, 'start'])->name('start_exam');
        Route::post('/request', [Exam::class, 'request'])->name('request_exam');
        Route::post('/submit', [Exam::class, 'submit'])->name('submit_exam');
    });

    Route::prefix('patient')->group(function () {
        Route::get('/search/{name}', [Patient::class, 'searchByName'])->name('search_patient');
        Route::post('/personal-information', [PersonalInformationController::class, 'update'])->name('edit_personal_information');
    });

    Route::prefix('user')->group(function () {
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('/add', [Admin::class, 'add'])->name('add-user');
        Route::post('/edit', [Admin::class, 'edit'])->name('edit-user');
    });

})->middleware(['auth:sanctum', 'verified', 'api']);
