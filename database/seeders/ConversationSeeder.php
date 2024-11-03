<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;

class ConversationSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 5 cuộc hội thoại giả
        Conversation::factory()->count(5)->create();
    }
}
