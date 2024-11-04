<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('111111'),
            'active' => 'active',
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('222222'),
            'active' => 'active',
            'email_verified_at' => now(),
        ]);

        // Tạo thêm 18 người dùng khác
        User::factory()->count(18)->create();
    }
}
