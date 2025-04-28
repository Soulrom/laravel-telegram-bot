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
        // Викликаємо сидер UserSeeder, щоб створити користувачів
        $this->call(UserSeeder::class);
    }
}
