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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('charge')->nullable();
            $table->integer('after_charge')->nullable();
            $table->string('status')->default('pending')->comment('Status: pending, success, rejected');
            $table->text('comment')->nullable();
            $table->text('details')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
