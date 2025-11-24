<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@example.com',
                'profile_photo' => null,
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengguna Demo',
                'email' => 'demo@example.com',
                'profile_photo' => null,
                'email_verified_at' => null,
                'password' => Hash::make('demo123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
