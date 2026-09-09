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
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->string('file_akta_pendirian')->nullable()->after('phone');
            $table->string('file_akta_perubahan')->nullable()->after('file_akta_pendirian');
            $table->string('file_npwp')->nullable()->after('file_akta_perubahan');
            $table->string('file_direksi')->nullable()->after('file_npwp');
            $table->string('file_nib')->nullable()->after('file_direksi');
            $table->string('file_domisili')->nullable()->after('file_nib');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'file_akta_pendirian',
                'file_akta_perubahan',
                'file_npwp',
                'file_direksi',
                'file_nib',
                'file_domisili',
            ]);
        });
    }
};
