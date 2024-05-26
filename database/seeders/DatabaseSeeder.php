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
            'password' => bcrypt('admin123'), // Ensuring password is hashed
            'role' => 'admin',
        ]);

        // Create a regular user
        User::factory()->create([
            'name' => 'Pelanggan',
            'email' => 'user@example.com',
            'password' => bcrypt('user123'), // Ensuring password is hashed
            'role' => 'user',
        ]);

    }
}
