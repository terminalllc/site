<?php
declare(strict_types=1);

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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_calculation_amount_at_general_rate');
            $table->dropColumn('amount_for_parking_first_seven_days');
            $table->dropColumn('amount_for_parking_general');
            $table->dropColumn('amount_for_issuing_car');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_calculation_amount_at_general_rate');
            $table->double('amount_for_parking_first_seven_days')->nullable();
            $table->double('amount_for_parking_general');
            $table->double('amount_for_issuing_car')->nullable();
        });
    }
};
