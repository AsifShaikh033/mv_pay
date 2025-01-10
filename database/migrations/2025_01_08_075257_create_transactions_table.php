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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id')->nullable()->default(null); 
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('charge', 10, 2)->default(0); 
            $table->decimal('post_balance', 10, 2)->default(0)->comment('After add new amount'); 
            $table->string('trx_type')->nullable()->comment('+', '-');
            $table->text('details')->nullable()->default(null); 
            $table->text('remark')->nullable()->default(null)->comment('referral_amount, spin_amount, other');
            $table->unsignedBigInteger('status')->default(0)->comment('0=pending, 1=success, 2=failed, 3=rejected');
            $table->string('payment_status')->nullable()->comment('pending, success,failed,rejected');
            $table->string('transaction_id')->nullable()->default(null); 
            $table->text('response_msg')->nullable()->default(null); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
