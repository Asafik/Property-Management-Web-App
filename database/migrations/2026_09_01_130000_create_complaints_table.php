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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('land_bank_units')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            
            $table->string('kategori')->default('lainnya'); // kebocoran, kelistrikan, struktur_dinding, plafon_atap, sanitasi_pipa, pintu_jendela, finishing_cat, lainnya
            $table->string('judul_keluhan');
            $table->text('deskripsi');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi', 'darurat'])->default('sedang');
            $table->enum('status', ['diajukan', 'diproses', 'pengecekan', 'selesai', 'ditolak'])->default('diajukan');
            
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_selesai')->nullable();
            
            $table->string('foto_keluhan')->nullable();
            $table->string('foto_penyelesaian')->nullable();
            
            $table->string('petugas_penanggung_jawab')->nullable();
            $table->text('catatan_perbaikan')->nullable();
            $table->decimal('biaya_perbaikan', 15, 0)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
