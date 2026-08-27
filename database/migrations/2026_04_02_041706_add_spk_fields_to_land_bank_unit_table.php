<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('land_bank_units', function (Blueprint $table) {
            $table->string('no_spk')->nullable()->after('id');
            $table->string('dokumen_spk')->nullable()->after('no_spk');
            $table->string('kontraktor')->nullable()->after('dokumen_spk');
        });
    }

    public function down(): void
    {
        Schema::table('land_bank_units', function (Blueprint $table) {
            $table->dropColumn(['no_spk', 'dokumen_spk', 'kontraktor']);
        });
    }
};