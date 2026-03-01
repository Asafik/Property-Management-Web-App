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
       Schema::table('customers', function (Blueprint $table) {
    $table->foreignId('land_bank_id')
          ->nullable()
          ->after('guest_id')
          ->constrained()
          ->nullOnDelete();

    $table->foreignId('unit_id')
          ->nullable()
          ->after('land_bank_id')
          ->constrained('land_bank_units')
          ->nullOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
