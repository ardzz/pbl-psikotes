<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Patient extends Controller
{
    /**
     * @throws ValidationException
     */
    function searchByName($name): JsonResponse
    {
        $patients = User::where('name', 'like', "%$name%")->where('user_type', 1)->select('id', 'name', 'email')->get();

        if ($patients->isEmpty()) {
            return response()->json(['message' => 'No patient found'], 404);
        }else{
            return response()->json($patients, 200);
        }
    }
}
