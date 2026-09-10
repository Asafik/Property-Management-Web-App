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
        Schema::create('master_dokumen_perizinans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokumen', 50)->unique();
            $table->string('nama_dokumen', 255);
            $table->string('kategori', 100)->default('Lainnya');
            $table->string('instansi_terkait', 255)->nullable();
            $table->integer('estimasi_hari')->nullable()->comment('Estimasi SLA pengerjaan dalam hari');
            $table->bigInteger('estimasi_biaya')->nullable()->comment('Estimasi biaya resmi / retribusi');
            $table->text('syarat_dokumen')->nullable()->comment('Checklist berkas syarat pengajuan');
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_required')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_dokumen_perizinans');
    }
};
