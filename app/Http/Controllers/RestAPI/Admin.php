<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Admin extends Controller
{
    function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'role' => 'required|in:doctor,patient'
        ]);

        $role = match ($validated['role']) {
            'doctor' => 3,
            'patient' => 1,
            default => 1,
        };

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'user_type' => $role
        ]);

        if ($user) {
            if ($validated['role'] == "doctor"){
                $user->update([
                    'email_verified_at' => now(),
                ]);
            }
            return response()->json(["message" => "User added successfully"], 200);
        }
        else {
            return response()->json(["message" => "User not added"], 400);
        }
    }
}
