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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image')->comment('Banner image path');
            $table->string('details')->comment('other title');
            $table->string('banner_type')->comment('top,bottom,middle');
            $table->integer('priority')->default(1)->comment('Priority for sorting');
            $table->integer('status')->default(1)->comment('Active status: 1 for active, 0 for inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
