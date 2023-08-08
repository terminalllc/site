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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('vin',17);
            $table->jsonb('containerImages')->nullable();
            $table->jsonb('terminalImages')->nullable();
            $table->jsonb('outImages')->nullable();
            $table->date('on_terminal_at')->nullable();
            $table->date('out_terminal_at')->nullable();
            $table->boolean('status')->default(false);
            $table->string('creater');
            $table->string('updater');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
