<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebConfig extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'web_config';

    // Fillable fields for mass assignment
    protected $fillable = [
        'web_title',
        'tagline',
        'logo',
        'icon',
        'footer_logo',
        'fav_icon',
        'primary_email',
        'secondary_email',
        'support_email',
        'primary_phone',
        'secondary_phone',
        'address',
        'about_us',
        'privacy_policy',
        'terms_conditions',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'linkedin_link',
        'youtube_link',
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'smtp_encryption',
        'color_primary',
        'color_secondary',
        'background_color',
        'font_family',
        'meta_keywords',
        'meta_description',
        'timezone',
        'currency',
        'maintenance_mode',
    ];

    // Cast fields to their respective data types
    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];
}
