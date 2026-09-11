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
        Schema::table('land_bank_units', function (Blueprint $table) {
            $table->string('certificate_no', 100)->nullable()->after('building_area');
            $table->string('file_certificate')->nullable()->after('certificate_no');
            $table->string('photo')->nullable()->after('file_certificate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('land_bank_units', function (Blueprint $table) {
            $table->dropColumn(['certificate_no', 'file_certificate', 'photo']);
        });
    }
};
