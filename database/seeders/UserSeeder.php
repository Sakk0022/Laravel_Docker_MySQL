<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // Подключение модели User (если она у вас есть)

class UserSeeder extends Seeder
{
    public function run()
    {
        // Пример добавления одного пользователя
        User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123')
        ]);

        // Или можно использовать фабрики для создания нескольких записей
        \App\Models\User::factory(10)->create(); // Создаст 10 пользователей
    }
}
