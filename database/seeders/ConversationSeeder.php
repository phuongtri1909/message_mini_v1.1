<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\User;

class ConversationSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 5 cuộc hội thoại giả
        Conversation::factory()->count(5)->create();

        // Tạo một cuộc trò chuyện cụ thể giữa User 1 và User 2
        $user1 = User::where('email', 'user1@gmail.com')->first();
        $user2 = User::where('email', 'user2@gmail.com')->first();
        
        if ($user1 && $user2) {
            Conversation::factory()->create([
                'name' => 'Cuộc hội thoại giữa ' . $user1->name . ' và ' . $user2->name,
                'is_group' => 0,
                'created_by' => $user1->id,
                'avatar' => null, // hoặc tên tệp avatar nếu có
            ]);

            // Tạo cuộc trò chuyện thứ hai giữa User 1 và User 3
            $user3 = User::where('email', 'user3@gmail.com')->first();
            if ($user3) {
                Conversation::factory()->create([
                    'name' => 'Cuộc hội thoại giữa ' . $user1->name . ' và ' . $user3->name,
                    'is_group' => 0,
                    'created_by' => $user1->id,
                    'avatar' => null, // hoặc tên tệp avatar nếu có
                ]);
            }
        }
    }
}
