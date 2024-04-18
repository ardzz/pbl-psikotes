<?php

use App\Http\Controllers\Auth\OauthGoogle;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
   return view('main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/personal-information', [ProfileController::class, 'editPersonal'])->name('personal.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/history', [HomeController::class, 'examHistory'])->name('examHistory');
    Route::get('/guides', [HomeController::class, 'guides'])->name('guides');
    Route::get('/about-mmpi2', [HomeController::class, 'aboutMmpi2'])->name('about-mmpi2');

    Route::get('/mmpi2', [HomeController::class, 'mmpi2'])->name('mmpi2');
    Route::get('/add-exam', [HomeController::class, 'enrollment'])->name('exam.enrollment');
    Route::get('/exams', [HomeController::class, 'exam'])->name('exam.manage');
});

Route::get('/oauth/callback', [OauthGoogle::class, 'handleGoogleCallback'])->name('oauth.callback');
Route::get('/oauth/redirect', [OauthGoogle::class, 'redirectToGoogle'])->name('oauth.redirect');


if (env('APP_ENV') === 'local') {
    Route::get('/login-as/{id}', [ProfileController::class, 'loginAs'])->name('login-as');
}


require __DIR__.'/auth.php';
require __DIR__.'/api.php';
