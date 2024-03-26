<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Models\Question as ModelsQuestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Question extends Controller
{
    public function show($id): JsonResponse
    {
        $question = ModelsQuestion::find($id);
        return $question ? response()->json($question) : response()->json(["message" => "Question not found"], 404);
    }

    public function store(Request $request)
    {
        $question = ModelsQuestion::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );

        return response()->json($question);
    }
}
