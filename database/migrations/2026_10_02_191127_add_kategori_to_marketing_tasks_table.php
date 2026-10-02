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
        Schema::table('marketing_tasks', function (Blueprint $table) {
            // kategori: sosmed = tugas konten sosial media, proyeksi = tugas akuisisi tamu/leads, umum = tugas operasional lainnya
            $table->enum('kategori', ['sosmed', 'proyeksi', 'umum'])->default('sosmed')->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketing_tasks', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
