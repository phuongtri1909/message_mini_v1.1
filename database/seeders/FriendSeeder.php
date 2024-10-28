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
        // Tạo một user cụ thể với thông tin xác định trước
        $user = User::factory()->create([
            'name' => 'huhe',
            'email' => 'huhe@gmail.com',
            'password' => bcrypt('huhe123456'), // Mật khẩu mặc định
        ]);

        // Tạo 10 người bạn cho user này
        Friend::factory()->count(10)->create([
            'user_id' => $user->id,
        ]);
    }
}