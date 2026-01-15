<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::updateOrCreate(['key' => 'site_name'], ['value' => 'MASK!OTAS']);
        \App\Models\Setting::updateOrCreate(['key' => 'primary_color'], ['value' => '#009688']); // Teal default
        \App\Models\Setting::updateOrCreate(['key' => 'logo_url'], ['value' => 'assets/images/logo.png']); // Path relative to frontend assets or public storage
    }
}
