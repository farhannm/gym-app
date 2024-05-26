<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [   
                'name' => 'Admin 1',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'Admin',
                'email' => 'admin@example.com',
                'phone' => '1234567890',
                'address' => '123 Admin Street',
                'join_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pelanggan 1',
                'username' => 'user1',
                'password' => Hash::make('user123'),
                'role' => 'Pelanggan',
                'email' => 'user1@example.com',
                'phone' => '0987654321',
                'address' => '456 User Lane',
                'join_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan lebih banyak data contoh jika diperlukan
        ]);
    }
}
