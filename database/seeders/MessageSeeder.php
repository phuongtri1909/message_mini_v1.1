<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy thông tin User 1 và User 2
        $user1 = User::where('email', 'user1@gmail.com')->first();
        $user2 = User::where('email', 'user2@gmail.com')->first();

        // Lấy cuộc trò chuyện giữa User 1 và User 2
        $conversation = Conversation::where(function ($query) use ($user1, $user2) {
            $query->where('created_by', $user1->id) // Sử dụng created_by
                  ->where('name', 'Cuộc hội thoại giữa ' . $user1->name . ' và ' . $user2->name);
        })->orWhere(function ($query) use ($user1, $user2) {
            $query->where('created_by', $user2->id) // Sử dụng created_by
                  ->where('name', 'Cuộc hội thoại giữa ' . $user1->name . ' và ' . $user2->name);
        })->first();

        if ($conversation) {
            // Tạo một số tin nhắn giữa User 1 và User 2
            for ($i = 0; $i < 10; $i++) {
                Message::factory()->create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $i % 2 == 0 ? $user1->id : $user2->id,
                    'message' => 'Đây là tin nhắn mẫu ' . ($i + 1),
                ]);
            }
        }
    }
}
