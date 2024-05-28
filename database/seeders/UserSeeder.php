<?php

namespace Database\Seeders;

use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make("adminadmin"),
            'user_type' => 2
        ])->assignRole('super_admin');

        $patients = [
            'YUNUS PAKAGE',
            'KIKY FITRAH RUMAKAT',
            'YOSUA KUDIAY',
            'STEVEN LEHALEWERIWA',
            'STEVEN KUDIAY',
        ];

        $i = 1;

        foreach ($patients as $patient) {
            $user = User::factory()->create([
                'name' => $patient,
                'email' => 'pasien' . $i . '@gmail.com',
                'password' => Hash::make("123"),
                'user_type' => 1
            ])->assignRole('patient');

            $personal_information = new PersonalInformation();
            $personal_information->user_id = $user->id;
            $personal_information->sex = collect(['m', 'f'])->random();
            $personal_information->save();

            $i++;
        }

        $doctors = [
            'SIMON PETRUS MATLY',
            'WIBE DAVID RUMBIAK',
            'YOHANES YULIUS KAMORI',
            'IVONNE APRILLIANTI SYARIF',
        ];
        $i = 1;
        foreach ($doctors as $doctor) {
            User::factory()->create([
                'name' => $doctor,
                'email' => 'dokter' . $i . '@gmail.com',
                'password' => Hash::make("123"),
                'user_type' => 3
            ])->assignRole('doctor');
            $i++;
        }
    }
}
