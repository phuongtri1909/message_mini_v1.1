<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 100 tin nhắn giả
        Message::factory()->count(100)->create();
    }
}