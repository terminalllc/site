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
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
            $table->double('payment_summa')->default(0);
            $table->string('user_clicked_payment_status')->nullable();
            $table->boolean('payment_status')->default(false);
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
            $table->dropColumn('client_id');
            $table->dropColumn('payment_summa');
            $table->dropColumn('user_clicked_payment_status');
            $table->dropColumn('payment_status');
        });
    }
};
