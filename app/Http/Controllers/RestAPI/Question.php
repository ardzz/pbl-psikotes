<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question as ModelsQuestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\matches;

class Question extends Controller
{
    public function show($id): JsonResponse
    {
        $question = ModelsQuestion::find($id);
        return $question ? response()->json($question) : response()->json(["message" => "Question not found"], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            "exam_id" => "required|exists:exams,id",
            "question_id" => "required|exists:questions,id",
            "answer" => "required|in:Yes,No,Unknown"
        ]);

        $answer = null;

        if(!is_null($request->answer)){
            $answer = match ($request->answer){
                "Yes" => true,
                "No" => false,
                "Unknown" => null
            };
        }

        $question = Answer::updateOrCreate([
            "question_id" => $request->question_id,
            "exam_id" => $request->exam_id,
            "answer" => $answer
        ]);

        return response()->json($question);
    }
}
