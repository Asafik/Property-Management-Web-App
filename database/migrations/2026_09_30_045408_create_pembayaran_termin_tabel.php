<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel pembayaran termin pembangunan unit
     * Mencatat jadwal & realisasi pembayaran kontraktor berdasarkan progress termin.
     */
    public function up(): void
    {
        Schema::create('pembayaran_termin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('development_progress_id');
            $table->foreign('development_progress_id')->references('id')->on('development_progress')->onDelete('cascade');
            $table->foreignId('land_bank_unit_id')->constrained('land_bank_units')->onDelete('cascade');

            $table->unsignedTinyInteger('termin_ke')->default(1)->comment('Urutan termin: 1, 2, 3, dst.');
            $table->string('nama_termin', 150)->comment('Nama/label termin: Termin 1 - Pondasi, dll.');
            $table->text('uraian_pekerjaan')->nullable()->comment('Deskripsi detail pekerjaan yang dibayar pada termin ini');

            // Syarat Pembayaran
            $table->decimal('syarat_progress_persen', 5, 2)->default(0)->comment('% progress fisik yang harus dicapai sebelum dibayar');
            $table->decimal('persentase_bayar', 5, 2)->default(0)->comment('% dari total nilai kontrak pada termin ini');
            $table->decimal('nominal', 20, 2)->default(0)->comment('Nominal rupiah termin ini');

            // Status
            $table->enum('status', ['menunggu', 'diajukan', 'disetujui', 'dibayar', 'ditolak'])->default('menunggu');
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->date('tanggal_ajuan')->nullable();
            $table->date('tanggal_bayar')->nullable();

            // Referensi Opname (no FK constraint since opname created separately)
            $table->unsignedBigInteger('opname_id')->nullable()
                ->comment('Opname yang menjadi dasar pencairan termin ini');

            // Bukti & Catatan
            $table->string('no_bukti_bayar', 100)->nullable();
            $table->string('file_bukti', 255)->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('dibayar_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->index(['development_progress_id', 'termin_ke']);
            $table->index(['land_bank_unit_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran_termin');
    }
};
