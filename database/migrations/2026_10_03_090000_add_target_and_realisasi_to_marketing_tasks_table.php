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
            $table->unsignedInteger('target_jumlah')->default(1)->nullable()->after('nama_tugas');
            $table->string('satuan_target', 50)->default('Item')->nullable()->after('target_jumlah');
            $table->unsignedInteger('realisasi_jumlah')->default(0)->nullable()->after('satuan_target');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketing_tasks', function (Blueprint $table) {
            $table->dropColumn(['target_jumlah', 'satuan_target', 'realisasi_jumlah']);
        });
    }
};
