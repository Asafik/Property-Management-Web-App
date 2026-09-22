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
        if (!Schema::hasTable('master_biaya_legalitas')) {
            Schema::create('master_biaya_legalitas', function (Blueprint $table) {
                $table->id();
                $table->string('kode_biaya', 50)->unique();
                $table->string('nama_biaya', 255);
                $table->string('kategori', 100)->default('Legalitas & Notaris');
                $table->string('tipe_perhitungan', 50)->default('nominal_tetap')->comment('nominal_tetap, persentase, fleksibel');
                $table->bigInteger('nominal_standar')->nullable()->comment('Estimasi acuan nominal');
                $table->decimal('persentase_standar', 5, 2)->nullable()->comment('Persentase dari deal price jika tipe persentase');
                $table->string('pihak_penanggung', 50)->default('perusahaan')->comment('pembeli, penjual, bagi_dua, perusahaan, opsional');
                $table->text('deskripsi')->nullable();
                $table->integer('urutan')->default(0);
                $table->boolean('is_standard')->default(false)->comment('Apakah komponen standar bawaan form');
                $table->boolean('is_required')->default(false);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_biaya_legalitas');
    }
};
