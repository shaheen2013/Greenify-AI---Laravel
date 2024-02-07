<?php

namespace Database\Seeders;

use App\Models\Settings;
use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'site_name' => 'Greenify AI',
            'site_title' => 'Find a Perfect Home in New Jersey',
            'contact_number' => '123456',
            'email' => 'admin@gmail.com',
            'timezone' => 'Asia/Dhaka (GMT+06:00)',
            'date_format' => 'yyyy-mm-dd',
            'currency' => 'USD',
            'address' => 'New Jersey',
            'map_location' => 'https://www.google.com/maps',
            'copyright' => 'copyright text',
            'light_logo' => 'https://www.google.com/maps',
            'dark_logo' => 'https://www.google.com/maps',
            'fav_icon' => 'https://www.google.com/maps',
        ]);

        SocialMedia::create([
            'twitter' => 'https://www.twitter.com',
            'facebook' => 'https://www.facebook.com',
            'instagram' => 'https://www.instagram.com',
            'linkedin' => 'https://www.linkedin.com',
            'youtube' => 'https://www.youtube.com',
            'tiktok' => 'https://www.tiktok.com',
            'threads' => 'https://www.threads.net',
        ]);
    }
}
