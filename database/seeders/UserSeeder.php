<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        ]);

        $patients = [
            'YUNUS PAKAGE',
            'KIKY FITRAH RUMAKAT',
            'YOSUA KUDIAY',
            'STEVEN LEHALEWERIWA',
            'STEVEN KUDIAY',
        ];

        $i = 1;

        foreach ($patients as $patient) {
            User::factory()->create([
                'name' => $patient,
                'email' => 'pasien' . $i . '@gmail.com',
                'password' => Hash::make("123"),
                'user_type' => 1
            ]);
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
            ]);
            $i++;
        }
    }
}
