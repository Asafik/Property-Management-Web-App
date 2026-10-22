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
    Schema::table('kpr_applications', function (Blueprint $table) {
        $table->foreignId('promo_id')
              ->nullable()
              ->after('banks_id')
              ->constrained('promos')
              ->nullOnDelete();

        $table->string('promo_name')->nullable()->after('promo_id');
        $table->decimal('promo_value', 15, 0)->default(0)->after('promo_name');
    });
}

public function down(): void
{
    Schema::table('kpr_applications', function (Blueprint $table) {
        $table->dropForeign(['promo_id']);
        $table->dropColumn(['promo_id', 'promo_name', 'promo_value']);
    });
}
};
