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
        Schema::table('akads', function (Blueprint $table) {
            if (!Schema::hasColumn('akads', 'lokasi_akad')) {
                $table->string('lokasi_akad')->nullable()->after('tanggal_akad');
            }
            if (!Schema::hasColumn('akads', 'nama_notaris')) {
                $table->string('nama_notaris')->nullable()->after('lokasi_akad');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akads', function (Blueprint $table) {
            if (Schema::hasColumn('akads', 'nama_notaris')) {
                $table->dropColumn('nama_notaris');
            }
            if (Schema::hasColumn('akads', 'lokasi_akad')) {
                $table->dropColumn('lokasi_akad');
            }
        });
    }
};
