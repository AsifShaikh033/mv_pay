<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebConfig;

class WebConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebConfig::create([
            'web_title' => 'title Website',
            'tagline' => 'Your trusted site',
            'logo' => 'uploads/web_config/demo-logo.png',
            'icon' => 'uploads/web_config/demo-icon.png',
            'footer_logo' => 'uploads/web_config/demo-footer-logo.png',
            'fav_icon' => 'uploads/web_config/demo-favicon.ico',
            'primary_email' => 'admin@demo.com',
            'secondary_email' => 'support@demo.com',
            'support_email' => 'help@demo.com',
            'primary_phone' => '+1-800-123-4567',
            'secondary_phone' => '+1-800-765-4321',
            'address' => '123 Demo Street, Demo City, Demo Country',
            'about_us' => 'This is a demo website created to showcase features.',
            'privacy_policy' => 'Your data is safe with us.',
            'terms_conditions' => 'Use this site responsibly.',
            'facebook_link' => 'https://facebook.com/demo',
            'twitter_link' => 'https://twitter.com/demo',
            'instagram_link' => 'https://instagram.com/demo',
            'linkedin_link' => 'https://linkedin.com/company/demo',
            'youtube_link' => 'https://youtube.com/demo',
            'smtp_host' => 'smtp.demo.com',
            'smtp_port' => '587',
            'smtp_username' => 'smtp_user',
            'smtp_password' => 'smtp_password',
            'smtp_encryption' => 'tls',
            'color_primary' => '#ff5733',
            'color_secondary' => '#33c1ff',
            'background_color' => '#f4f4f4',
            'font_family' => 'Arial, sans-serif',
            'meta_keywords' => 'demo, website, example',
            'meta_description' => 'This is a demo website for demonstration purposes.',
            'timezone' => 'UTC',
            'currency' => 'USD',
            'maintenance_mode' => false,
        ]);
    }
}
