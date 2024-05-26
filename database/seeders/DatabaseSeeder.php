<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => bcrypt('admin123'), // Ensuring password is hashed
            'role' => 'Admin',
            'phone' => '1234567890',
            'address' => '123 Admin Street',
            'join_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create a regular user
        User::factory()->create([
            'name' => 'Pelanggan',
            'username' => 'pelanggan',
            'password' => bcrypt('user123'), // Ensuring password is hashed
            'role' => 'Pelanggan',
            'email' => 'user1@example.com',
            'phone' => '0987654321',
            'address' => '456 User Lane',
            'join_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
