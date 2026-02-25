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
        Schema::table('land_banks', function (Blueprint $table) {
            $table->foreignId('company_profile_id')
                  ->after('id') // opsional
                  ->nullable()
                  ->constrained('company_profiles')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('land_banks', function (Blueprint $table) {
            $table->dropForeign(['company_profile_id']);
            $table->dropColumn('company_profile_id');
        });
    }
};
