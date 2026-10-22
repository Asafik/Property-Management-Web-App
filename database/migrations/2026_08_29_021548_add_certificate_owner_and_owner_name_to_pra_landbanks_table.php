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
        Schema::table('pra_landbanks', function (Blueprint $table) {
            $table->string('owner_name')->nullable()->after('ownership_status'); // Nama Pemilik Tanah
            $table->string('certificate_owner')->nullable()->after('owner_name'); // Nama di Sertifikat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            $table->dropColumn(['owner_name', 'certificate_owner']);
        });
    }
};
