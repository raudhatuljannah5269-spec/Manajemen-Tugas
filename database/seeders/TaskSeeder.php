<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'user_id' => 1, // Admin Sistem
                'title' => 'Membuat Halaman Login',
                'description' => 'Membuat halaman login untuk sistem task management.',
                'status' => 1, // selesai
                'deadline' => '2025-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Membuat Dashboard',
                'description' => 'Menyiapkan dashboard utama untuk monitoring task.',
                'status' => 0, // pending
                'deadline' => '2025-12-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Pengguna Demo
                'title' => 'Fitur CRUD Task',
                'description' => 'Menambahkan fitur create, update, dan delete task.',
                'status' => 0,
                'deadline' => '2025-12-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
