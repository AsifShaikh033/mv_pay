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
        Schema::table('operators', function (Blueprint $table) {
            $table->string('OperatorCode')->change(); // Change INT to VARCHAR
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->integer('OperatorCode')->change();
    }
};
