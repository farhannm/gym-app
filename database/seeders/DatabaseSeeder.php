<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Trainer;
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

        // Create a specific trainer
        Trainer::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123-456-7890',
            'specialization' => 'Strength Training',
            'join_date' => now(),
        ]);

        // Create specific class
        Classes::factory()->create([
            'name' => 'Yoga',
            'description' => 'A relaxing yoga class',
            'start_time' => '2024-06-05 08:00:00',
            'end_time' => '2024-06-05 09:00:00',
            'trainer_id' => 1, // Assuming a trainer with ID 1 exists
        ]);

    }
}
