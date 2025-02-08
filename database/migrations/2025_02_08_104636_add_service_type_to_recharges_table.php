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
        Schema::table('recharges', function (Blueprint $table) {
            $table->string('serviceType')->after('number')->nullable()->comment('Type of service like Prepaid/Postpaid/DTH');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recharges', function (Blueprint $table) {
            $table->dropColumn('serviceType');

        });
    }
};
