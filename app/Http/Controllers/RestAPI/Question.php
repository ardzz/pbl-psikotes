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
            "question_id" => "required|exists:questions,id",
            "answer" => "required|in:Yes,No,null"
        ]);

        $answer = null;

        if(!is_null($request->answer)){
            $answer = match ($request->answer){
                "Yes" => true,
                "No" => false,
            };
        }

        $question = Answer::updateOrCreate([
            "user_id" => Auth::user()->id,
            "question_id" => $request->question_id,
            "answer" => $answer
        ]);

        return response()->json($question);
    }
}
