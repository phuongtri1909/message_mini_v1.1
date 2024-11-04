<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chạy seeder người dùng
        $this->call(UserSeeder::class);

        // Chạy seeder bạn bè
        $this->call(FriendSeeder::class);

        // Chạy seeder cuộc hội thoại
        $this->call(ConversationSeeder::class);

        // Chạy seeder tin nhắn
        $this->call(MessageSeeder::class);
        // $this->call(SocialsSeeder::class);
    }
}
