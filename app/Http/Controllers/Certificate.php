<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\Filament\PatientPanelProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class Certificate extends Controller
{
    function index(int $id){
        $exam = \App\Models\Exam::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        if (!$exam->validated) {
            abort(403);
        }
        return view('filament.patient.pages.certificate', compact('exam'));
    }
}
