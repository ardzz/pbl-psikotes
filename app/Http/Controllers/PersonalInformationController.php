<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonalInformationController extends Controller
{
    public function createPersonalInformation($userId)
    {
        $user = User::findOrFail($userId);
        return view('users.create_personal_information', compact('user'));
    }

    public function storePersonalInformation(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'NIK' => 'required|string|unique:personal_informations',
            'address' => 'required|string',
            'occupation' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Informasi pribadi gagal ditambahkan');
        }

        try {
            $personalInfo = PersonalInformation::create([
                'user_id' => $userId,
                'NIK' => $request->NIK,
                'address' => $request->address,
                'occupation' => $request->occupation,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
            ]);

            return redirect()->route('users.show', $userId)->with('success', 'Informasi pribadi berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('users.show', $userId)->with('error', 'Terdapat masalah di server');
        }
    }

    public function editPersonalInformation($userId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::findOrFail($userId);
        $personalInfo = $user->personalInformation;
        return view('users.edit_personal_information', compact('user', 'personalInfo'));
    }

    public function updatePersonalInformation(Request $request, $userId)
    {
        $personalInfo = PersonalInformation::where('user_id', $userId)->first();

        $validator = Validator::make($request->all(), [
            'NIK' => 'required|string|unique:personal_informations,NIK,' . $personalInfo->id,
            'address' => 'required|string',
            'occupation' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informasi pribadi gagal diperbarui </br> Periksa kembali data Anda');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $personalInfo->update([
                'NIK' => $request->NIK,
                'address' => $request->address,
                'occupation' => $request->occupation,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
            ]);

            toastr()->success('Informasi pribadi berhasil diperbarui');
            return redirect()->route('users.show', $userId);
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah di server');
            return redirect()->route('users.show', $userId);
        }
    }

    public function destroyPersonalInformation($userId)
    {
        $personalInfo = PersonalInformation::where('user_id', $userId)->first();

        try {
            $personalInfo->delete();
            toastr()->success('Informasi pribadi berhasil dihapus');
            return redirect()->route('users.show', $userId);
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah di server');
            return redirect()->route('users.show', $userId);
        }
    }
}
