<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Friend;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 20 user ngẫu nhiên
        $users = User::factory()->count(20)->create();

        // Tạo 10 người bạn cho mỗi user
        foreach ($users as $user) {
            // Lấy ngẫu nhiên 10 user khác để làm bạn
            $friendIds = $users->where('id', '!=', $user->id)->random(10)->pluck('id');

            foreach ($friendIds as $friendId) {
                Friend::factory()->create([
                    'user_id' => $user->id,
                    'friend_id' => $friendId,
                ]);
            }
        }
    }
}