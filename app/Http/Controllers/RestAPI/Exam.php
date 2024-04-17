<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Notifications\ExamCreated;
use Illuminate\Http\JsonResponse;
use App\Models\Exam as ExamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class Exam extends Controller
{
    function start(): JsonResponse
    {
        $userId = auth()->id();
        $exam = ExamModel::where("user_id", $userId)->whereNull("start_time")->whereNull("end_time")->first();

        if ($exam == null) {
            return response()->json(["message" => "Exam not found or already started/finished"], 404);
        }elseif ($exam->expired_time < now()) {
            return response()->json(["message" => "Exam expired"], 400);
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
    function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id,user_type,1',
            'doctor_id' => 'required|integer|exists:users,id,user_type,3',
            'purpose' => 'required|string',
            'expired_date' => 'required|date|after_or_equal:today',
            'expired_hour' => 'required|string',
        ],[
            'expired_hour.required' => 'The expired hour field is required.',
            'expired_hour.string' => 'The expired hour field must be a string.',
            'expired_hour.after_or_equal' => 'The expired hour field must be after or equal to ' . now()->addMinutes(100)->format('H:i') . ' (minimum 100 minutes from now).',
            'expired_date.required' => 'The expired date field is required.',
            'expired_date.date' => 'The expired date field must be a date.',
        ]);


        $expiredTime = $validated['expired_date'] . ' ' . $validated['expired_hour'];
        $last_exam = ExamModel::where('user_id', $validated['user_id'])->whereNull('end_time')->first();

        if ($last_exam) {
            return response()->json(["message" => "User already has an exam that is not finished"], 400);
        }
        elseif (now()->addMinutes(100) > $expiredTime) {
            return response()->json(["message" => "The expired date must be after or equal to " . now()->addMinutes(100)->format('H:i') . " (minimum 100 minutes from now)"], 400);
        }

        $exam = ExamModel::create([
            'user_id' => $validated['user_id'],
            'doctor_id' => $validated['doctor_id'],
            'purpose' => $validated['purpose'],
            'expired_time' => $expiredTime,
        ]);

        if ($exam) {
            $exam->user->notify(new ExamCreated($exam));
            return response()->json(["message" => "Exam added successfully"], 200);
        } else {
            return response()->json(["message" => "Exam not added"], 400);
        }
    }

    public function delete(Request $request)
    {

        $userId = auth()->id();
        $id = $request->id;

        $deleted = ExamModel::where('user_id', $userId)
            ->where('id', $id)
            ->delete();

        if ($deleted) {
            return response()->json(["message" => "Exam deleted successfully"], 200);
        } else {
            return response()->json(["message" => "Exam not found for deletion"], 404);
        }
    }
}
