<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user (created on every deployment)
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@looterstrike.fr'],
            [
                'name' => 'Admin',
                'email' => 'admin@looterstrike.fr',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
            ]
        );

        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]
        );

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
