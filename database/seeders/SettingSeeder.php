<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate([
            'key' => 'app_name', 
            'value' => config('app.name')
        ]);

        Setting::updateOrCreate([
            'key' => 'app_logo', 
            'value' => asset('assets/user/assets/img/logo.png')
        ]);
    }
}
