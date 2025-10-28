<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'User', 'password' => Hash::make('password'), 'role' => 'user']
        );
        // пост юзера
        Post::updateOrCreate(
            ['title' => 'Мой пост', 'user_id' => $user->id],
            ['body' => 'Текст поста обычного пользователя.']
        );
        // пост "чужой" — создадим второму юзеру
        $other = User::factory()->create(['role' => 'user']);
        Post::factory()->create(['user_id' => $other->id]);
    }
}