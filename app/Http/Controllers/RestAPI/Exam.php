<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Notifications\ExamApproved;
use Illuminate\Http\JsonResponse;
use App\Models\Exam as ExamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class Exam extends Controller
{
    function start(): JsonResponse
    {
        $userId = auth()->id();
        $exam = ExamModel::where("user_id", $userId)->whereNull("start_time")->whereNull("end_time")->first();

        if ($exam == null) {
            return response()->json(["message" => "Exam not found or already started/finished"], 404);
        }else{
            $exam->update([
                "start_time" => now()
            ]);
            return response()->json(["message" => "Exam successfully started"], 200);
        }
    }

    /**
     * @throws ValidationException
     */
    function approve(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'exam_id' => 'required|integer|exists:exams,id',
            'doctor_id' => 'required|integer|exists:users,id,user_type,3',
        ]);

        $exam = ExamModel::where('id', $validated['exam_id'])->first();
        $update = $exam->update([
                'doctor_id' => $validated['doctor_id'],
                'approved' => true
            ]);

        if ($update) {
            $exam->user->notify(new ExamApproved($exam));
            return response()->json(["message" => "Exam approved successfully"], 200);
        } else {
            return response()->json(["message" => "Exam not approved"], 400);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|integer|exists:exams,id'
        ]);

        $deleted = ExamModel::where('id', $request->exam_id)->delete();

        if ($deleted) {
            return response()->json(["message" => "Exam deleted successfully"], 200);
        } else {
            return response()->json(["message" => "Exam not found for deletion"], 404);
        }
    }

    public function finish()
    {
        $exam = auth()->user()->getUnfinishedExam();

        if ($exam == null) {
            return response()->json(["message" => "Exam not found"], 404);
        }elseif ($exam->end_time !== null) {
            return response()->json(["message" => "Exam already finished"], 400);
        }else{
            if($exam->endExam()) {
                return response()->json(["message" => "Exam successfully finished"]);
            }
            return response()->json(["message" => "There was an error finishing the exam"], 500);
        }
    }

    public function request(Request $request)
    {
        $request->validate([
            'purpose' => 'required|string',
        ]);

        $my_exam = ExamModel::where('user_id', auth()->id())->get();

        $unstarted_exam = $my_exam->whereNull('start_time')->whereNull('end_time')->where('approved', true);
        $unfinished_exam = $my_exam->where('start_time', '!=', null)->whereNull('end_time')->where('approved', true);
        $unverified_exam = $my_exam->where('approved', false);



        if ($unverified_exam->count() > 0) {
            return response()->json(["message" => "You already requested an exam, please wait for approval"], 400);
        }elseif ($unstarted_exam->count() > 0) {
            return response()->json(["message" => "You have an unstarted exam"], 400);
        }elseif ($unfinished_exam->count() > 0) {
            foreach ($unfinished_exam as $exam) {
                if (!$exam->isExpired()) {
                    return response()->json(["message" => "You have an unfinished exam"], 400);
                }
            }
        }

        $exam = new ExamModel();
        $exam->user_id = auth()->id();
        $exam->purpose = $request->purpose;
        $exam->save();

        return response()->json(["message" => "Exam requested successfully"], 200);
    }

    function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id,user_type,1',
            'doctor_id' => 'required|integer|exists:users,id,user_type,3',
            'purpose' => 'required|string',
        ]);

        $my_exam = ExamModel::where('user_id', $validated['user_id']);
        $unstarted_exam = $my_exam->whereNull('start_time')->whereNull('end_time')->get();
        $unfinished_exam = $my_exam->whereNull('end_time')->get();

        if ($unstarted_exam->count() > 0) {
            return response()->json(["message" => "User have an unstarted exam"], 400);
        }elseif ($unfinished_exam->count() > 0) {
            return response()->json(["message" => "User have an unfinished exam"], 400);
        }

        $exam = ExamModel::create([
            'user_id' => $validated['user_id'],
            'doctor_id' => $validated['doctor_id'],
            'purpose' => $validated['purpose'],
            'approved' => true
        ]);

        if ($exam) {
            $exam->user->notify(new ExamApproved($exam));
            return response()->json(["message" => "Exam added successfully"], 200);
        }
        else {
            return response()->json(["message" => "Exam not added"], 400);
        }
    }
}
