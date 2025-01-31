<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceCashbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_cashbacks', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->integer('balance'); // Balance column with precision
            $table->integer('cashback'); // Cashback column with precision
            $table->string('category'); // Cashback column with precision
            $table->tinyInteger('status')->default(0); // Status column with default value 0
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_cashbacks');
    }
}
