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
        // Buat admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@bowlkuy.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        // Buat user biasa untuk testing
        User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        // Seed menu
        $this->call(MenuSeeder::class);
    }
}
