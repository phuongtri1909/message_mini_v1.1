<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Socials;

class SocialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Socials::create([
            'name' => 'Zalo',
            'key' => 'zalo',
            'sub' => 'Cập nhật mã giảm giá',
            'icon' => asset('assets/images/svg/zalo.svg'),
            'url' => 'https://zalo.me/your-account'
        ]);

        Socials::create([
            'name' => 'YouTube',
            'key' => 'youtube',
            'sub' => 'YouTube Channel',
            'icon' => asset('assets/images/svg/youtube.svg'),
            'url' => 'https://youtube.com/your-channel'
        ]);

        Socials::create([
            'name' => 'Telegram',
            'key' => 'telegram',
            'sub' => 'Telegram Channel',
            'icon' => asset('assets/images/svg/telegram.svg'),
            'url' => 'https://t.me/your-channel'
        ]);

        Socials::create([
            'name' => 'Facebook',
            'key' => 'facebook',
            'sub' => 'Facebook Page',
            'icon' => asset('assets/images/svg/facebook.svg'),
            'url' => 'https://facebook.com/your-page'
        ]);
    }
}