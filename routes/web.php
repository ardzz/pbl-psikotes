<?php

use App\Http\Controllers\OauthGoogle;
use Illuminate\Support\Facades\Route;

Route::get('/google/callback', [OauthGoogle::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/', function () {
    return view('welcome');
});
