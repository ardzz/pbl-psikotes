<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
    public function createPersonalInformation($userId)
{
    $user = User::findOrFail($userId);
    return view('users.create_personal_information', compact('user'));
}

// Menyimpan informasi pribadi baru ke dalam basis data
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
        toastr()->error('Informasi pribadi gagal ditambahkan </br> Periksa kembali data Anda');
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
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

        toastr()->success('Informasi pribadi berhasil ditambahkan');
        return redirect()->route('users.show', $userId);
    } catch (\Throwable $th) {
        toastr()->warning('Terdapat masalah di server');
        return redirect()->route('users.show', $userId);
    }
}

// Menampilkan formulir untuk mengedit informasi pribadi
public function editPersonalInformation($userId)
{
    $user = User::findOrFail($userId);
    $personalInfo = $user->personalInformation;
    return view('users.edit_personal_information', compact('user', 'personalInfo'));
}

// Menyimpan perubahan informasi pribadi yang diedit ke dalam basis data
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

// Menghapus informasi pribadi
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
