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
        Schema::create('spks', function (Blueprint $table) {
            $table->id();
            $table->string('no_spk')->unique();
            $table->foreignId('land_bank_id')->constrained('land_banks')->onDelete('cascade');
            $table->foreignId('land_bank_unit_id')->nullable()->constrained('land_bank_units')->onDelete('set null');
            
            $table->string('jenis_spk')->default('Pembangunan Unit'); // Pembangunan Unit, Infrastruktur, Fasilitas Umum, Cut & Fill, Renovasi, Lainnya
            $table->string('nama_pekerjaan');
            $table->text('deskripsi_pekerjaan')->nullable();
            
            // Pihak Pertama (Pemberi Tugas / Developer)
            $table->string('pihak_pertama_nama')->nullable();
            $table->string('pihak_pertama_jabatan')->nullable();
            $table->string('pihak_pertama_perusahaan')->nullable();
            $table->text('pihak_pertama_alamat')->nullable();
            $table->string('pihak_pertama_telepon')->nullable();

            // Pihak Kedua (Kontraktor / Pemborong / Penerima Tugas)
            $table->string('kontraktor_nama'); // Nama Badan Usaha / Perorangan
            $table->string('kontraktor_pic')->nullable(); // Nama Penanggung Jawab / Mandor
            $table->string('kontraktor_ktp')->nullable();
            $table->string('kontraktor_telepon')->nullable();
            $table->text('kontraktor_alamat')->nullable();
            $table->string('kontraktor_bank')->nullable();
            $table->string('kontraktor_rekening')->nullable();
            $table->string('kontraktor_atas_nama')->nullable();

            // Finansial & Waktu
            $table->date('tanggal_spk');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('durasi_hari')->default(0);
            $table->decimal('nilai_kontrak', 15, 2)->default(0);
            $table->string('sistem_pembayaran')->default('termin'); // termin, opname, lumpsum
            
            // Status & Progress
            $table->string('status')->default('draft'); // draft, berjalan, selesai, dibatalkan
            $table->integer('progress')->default(0); // 0 - 100
            
            // Dokumen & Syarat
            $table->string('file_lampiran')->nullable(); // Berkas pendukung jika ada
            $table->longText('pasal_syarat_ketentuan')->nullable(); // Klausul perjanjian
            $table->text('keterangan')->nullable(); // Catatan khusus

            $table->timestamps();
        });

        Schema::create('spk_termins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spk_id')->constrained('spks')->onDelete('cascade');
            $table->integer('termin_ke');
            $table->string('nama_tahap'); // contoh: Termin 1 (DP / Pondasi), Termin 2 (Struktur), Retensi (5%)
            $table->decimal('persentase', 5, 2)->default(0); // e.g. 20.00
            $table->decimal('nominal', 15, 2)->default(0);
            $table->decimal('syarat_progress', 5, 2)->default(0); // e.g. 20%
            $table->string('status_bayar')->default('belum_dibayar'); // belum_dibayar, proses, lunas
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk_termins');
        Schema::dropIfExists('spks');
    }
};
