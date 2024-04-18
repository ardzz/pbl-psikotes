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
        $currentExam = Auth::user()->getUnfinishedExam();
        if (!$currentExam) {
            return response()->json(["message" => "No exam started"], 400);
        }
        elseif (now()->greaterThanOrEqualTo($currentExam->expired_time)){
            return response()->json(["message" => "Exam has expired"], 400);
        }
        else{
            $answer = Answer::where("question_id", $id)->where("exam_id", $currentExam->id)->first();
            return response()->json([
                "question" => $question,
                "answer" => $answer
            ]);
        }
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

        $question = Answer::where("question_id", $request->question_id)->where("exam_id", $request->exam_id)->first();
        if(!$question){
            $question_model = new Answer();
            $question_model->exam_id = $request->exam_id;
            $question_model->question_id = $request->question_id;
            $question_model->answer = $answer;
            $question_model->save();
            $question = $question_model;
        }else{
            $question->answer = $answer;
            $question->save();
        }

        return response()->json($question->toArray());
    }
}
