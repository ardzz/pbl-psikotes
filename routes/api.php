<?php

use App\Http\Controllers\RestAPI\Exam;
use App\Http\Controllers\RestAPI\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/question/{id}", [Question::class, "show"]);
    Route::post("/question", [Question::class, "store"]);

    Route::get("/exam/start", [Exam::class, "start"]);
    Route::get("/exam/delete", [Exam::class, "delete"]);
});
