<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Додаємо користувачів з потрібними полями
        User::create([
            'name' => 'John Doe',
            'telegram_id' => '123456789',
            'subscribed' => true,
        ]);

        User::create([
            'name' => 'Jane Smith',
            'telegram_id' => '987654321',
            'subscribed' => true,
        ]);

        // Можна додати ще кілька користувачів для тестування
    }
}
