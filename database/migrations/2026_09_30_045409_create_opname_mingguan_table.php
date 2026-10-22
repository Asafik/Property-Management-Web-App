<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel opname mingguan (laporan progres fisik mingguan)
     * Digunakan sebagai dasar pencairan termin pembayaran.
     */
    public function up(): void
    {
        Schema::dropIfExists('opname_mingguan');
        Schema::create('opname_mingguan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('development_progress_id');
            $table->foreign('development_progress_id')->references('id')->on('development_progress')->onDelete('cascade');
            $table->foreignId('land_bank_unit_id')->constrained('land_bank_units')->onDelete('cascade');


            // Identitas Opname
            $table->string('no_opname', 50)->nullable()->comment('Nomor opname, misal: OPN-2024-001');
            $table->unsignedSmallInteger('minggu_ke')->default(1)->comment('Minggu ke-berapa dalam proyek');
            $table->date('tanggal_mulai_minggu');
            $table->date('tanggal_akhir_minggu');

            // Progress Fisik
            $table->decimal('progress_minggu_ini', 5, 2)->default(0)->comment('% progress yang dikerjakan minggu ini');
            $table->decimal('progress_kumulatif', 5, 2)->default(0)->comment('Total % progress kumulatif sampai minggu ini');

            // Rincian Uraian Pekerjaan Minggu Ini (JSON array of items)
            $table->json('uraian_pekerjaan')->nullable()->comment('Array uraian pekerjaan yang diselesaikan minggu ini');

            // Tenaga Kerja & Material
            $table->unsignedSmallInteger('jumlah_pekerja')->nullable();
            $table->text('material_digunakan')->nullable();

            // Masalah & Solusi
            $table->text('kendala')->nullable();
            $table->text('solusi')->nullable();
            $table->text('rencana_minggu_depan')->nullable();

            // Status & Persetujuan
            $table->enum('status', ['draft', 'diajukan', 'disetujui', 'ditolak'])->default('draft');
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('tanggal_disetujui')->nullable();
            $table->text('catatan_reviewer')->nullable();

            // Dokumentasi
            $table->string('foto_dokumentasi', 255)->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();
            $table->index(['development_progress_id', 'minggu_ke']);
            $table->index(['land_bank_unit_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opname_mingguan');
    }
};
