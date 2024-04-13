<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class PersonalInformationController extends Controller
{
    public function update(Request $request): JsonResponse
    {
        $validator = Validator::make($request::all(), [
            'nik' => 'integer',
            'occupation' => 'string',
            'birthdate' => 'date',
            'phone_number' => 'string',
            'marital_status' => 'string',
            'education' => 'string',
            'sex' => Rule::in(['m', 'f']),
            'province' => 'string',
            'city' => 'string',
            'district' => 'string',
            'sub_district' => 'string',
            'address' => 'string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $personal_information = auth()->user()->personal_information;

        if ($personal_information == null) {
            $personal_information = new PersonalInformation();
            $personal_information->user_id = auth()->user()->id;
            $personal_information->save();
        }

        $personal_information->fill($request::all());

        if ($personal_information->save()) {
            return response()->json(['message' => 'Personal Information updated successfully'], 200);
        }else{
            return response()->json(['error' => 'Failed to update Personal Information'], 500);
        }
    }
}
