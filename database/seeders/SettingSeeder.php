<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting_names = [
            'bank_name',
            'bank_account',
            'bank_account_name',
            'amount',

            'midtrans_client_key',
            'midtrans_server_key',
            'midtrans_environment',
            'midtrans_enabled',

            'whatsapp_api_url',
            'whatsapp_api_token',
            'whatsapp_api_session',
            'whatsapp_api_enabled',
        ];

        foreach ($setting_names as $setting_name) {
            \App\Models\Setting::create([
                'name' => $setting_name,
            ]);
        }
    }
}