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
        Schema::create('notaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_notaris');
            $table->string('no_sk')->nullable();
            $table->string('wilayah_kerja')->nullable();
            $table->text('alamat_kantor')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('nama_kontak_person')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('atas_nama_rekening')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notaris');
    }
};
