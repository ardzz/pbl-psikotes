<?php

use App\Http\Controllers\Auth\OauthGoogle;
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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/oauth/callback', [OauthGoogle::class, 'handleGoogleCallback'])->name('oauth.callback');
Route::get('/oauth/redirect', [OauthGoogle::class, 'redirectToGoogle'])->name('oauth.redirect');

require __DIR__.'/auth.php';
