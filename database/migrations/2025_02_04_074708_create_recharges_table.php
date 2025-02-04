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
        Schema::create('recharges', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->comment('Telecom circle ID');
            $table->string('number')->nullable()->comment('numbers like mobile,dth,lic all type will be here');
            $table->string('operator')->nullable()->comment('Telecom operator name (e.g., JIO, Airtel)');
            $table->string('circle')->nullable()->comment('Telecom circle ID');
            $table->integer('amount')->nullable()->comment('Telecom circle ID');
            $table->string('user_tx')->unique()->nullable()->comment('Unique transaction ID from request');
            $table->string('status')->nullable()->default('pending')->comment('Status: pending, success, failed'); 
            $table->string('format')->nullable()->default('json')->comment('json');
            $table->json('api_response')->nullable()->comment('Full API response stored as JSON');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recharges');
    }
};
