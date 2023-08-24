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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('name_car');
            $table->string('vin_car');
            $table->string('model_tow_track');
            $table->string('number_tow_track');
            $table->string('number_trailer');
            $table->string('name_driver');
            $table->string('passport_driver');
            $table->string('phone_driver');
            $table->date('date_pick_up');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
