<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('web_config', function (Blueprint $table) {
            $table->id();
            $table->string('web_title')->nullable();
            $table->string('tagline')->nullable(); // For the website tagline
            $table->string('logo')->nullable(); // Website logo
            $table->string('icon')->nullable(); // Browser tab icon
            $table->string('footer_logo')->nullable(); // Footer-specific logo
            $table->string('fav_icon')->nullable(); // Favicon
            $table->string('primary_email')->nullable(); // Main contact email
            $table->string('secondary_email')->nullable(); // Secondary email
            $table->string('support_email')->nullable(); // Support email
            $table->string('primary_phone')->nullable(); // Main contact number
            $table->string('secondary_phone')->nullable(); // Secondary phone number
            $table->text('address')->nullable(); // Physical address
            $table->text('about_us')->nullable(); // About us section content
            $table->text('privacy_policy')->nullable(); // Privacy policy content
            $table->text('terms_conditions')->nullable(); // Terms and conditions content

            // Social Media Links
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('youtube_link')->nullable();

            // SMTP Settings
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_encryption')->nullable();

            // Appearance Settings
            $table->string('color_primary')->nullable(); // Primary color for the site
            $table->string('color_secondary')->nullable(); // Secondary color
            $table->string('background_color')->nullable(); // Background color
            $table->string('font_family')->nullable(); // Default font family

            // SEO Settings
            $table->string('meta_keywords')->nullable(); // Meta keywords for the site
            $table->text('meta_description')->nullable(); // Meta description

            // Other Configuration
            $table->string('timezone')->nullable(); // Timezone setting
            $table->string('currency')->default('USD'); // Default currency
            $table->boolean('maintenance_mode')->default(false); // Maintenance mode flag

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_config');
    }
};
