<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kpr_applications', function (Blueprint $table) {
            $table->string('berita_acara')->nullable()->after('catatan')
                  ->comment('Path file berita acara verifikasi KPR');
        });
    }

    public function down(): void
    {
        Schema::table('kpr_applications', function (Blueprint $table) {
            $table->dropColumn('berita_acara');
        });
    }
};