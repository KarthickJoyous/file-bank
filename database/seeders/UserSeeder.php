<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'Demo',
            'email' => "demo@demo.com",
            'email_status' => YES,
            'email_verified_at' => now(),
            'password' => Hash::make('Demo@123')
        ]);

        User::updateOrCreate([
            'name' => 'Test',
            'email' => "test@demo.com",
            'email_status' => NO,
            'password' => Hash::make('Demo@123')
        ]);
    }
}
