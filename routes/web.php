<?php

use App\Http\Controllers\OauthGoogle;
use Illuminate\Support\Facades\Route;

Route::get('/oauth/callback', [OauthGoogle::class, 'handleGoogleCallback'])->name('oauth.callback');

Route::get('/', function () {
    return view('welcome');
});
