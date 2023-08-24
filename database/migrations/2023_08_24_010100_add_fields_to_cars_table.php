<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('power_of_attorney_delivery')->nullable();
            $table->string('power_of_attorney_import')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('power_of_attorney_delivery');
            $table->dropColumn('power_of_attorney_import');
        });
    }
};
