<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate([
            'name' => 'Demo',
            'email' => "demo@demo.com",
            'password' => Hash::make('Demo@123')
        ]);

        Admin::updateOrCreate([
            'name' => 'Test',
            'email' => "test@demo.com",
            'password' => Hash::make('Demo@123')
        ]);
    }
}
