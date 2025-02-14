<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id'); 
            $table->string('upi_id'); 
            $table->string('barcode')->nullable(); 
            $table->string('account_holder_name')->nullable(); 
            $table->string('bank_name')->nullable(); 
            $table->string('branch_name')->nullable(); 
            $table->string('ifsc_code')->nullable(); 
            $table->string('account_number')->nullable(); 
            $table->tinyInteger('status')->default(1); 
            $table->timestamps(); 

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_details');
    }
}
