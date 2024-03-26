<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Exam as ExamModel;

class Exam extends Controller
{
    function start(): JsonResponse
    {
        $userId = auth()->id();
        $exam = ExamModel::where("user_id", $userId)->whereNull("end_time")->first();

        if ($exam || ExamModel::where("user_id", $userId)->where("end_time", ">", now()->subMinutes(30))->exists()) {
            $message = $exam ? "You have an active exam" : "You have taken an exam in the last 30 minutes";
            return response()->json(["message" => $message], 400);
        }

        $exam = ExamModel::create(['user_id' => $userId, 'start_time' => now()]);
        $exam->user()->update(['exam_id' => $exam->id]);

        return response()->json(["message" => "Exam started"], 200);
    }
}
