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
        Schema::create('serah_terimas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();

            $table->string('no_bast')->unique();
            $table->date('tanggal_serah_terima');
            $table->string('lokasi_serah_terima');

            $table->text('catatan')->nullable();
            $table->json('checklist')->nullable();

            $table->string('foto_serah_kunci')->nullable();
            $table->string('foto_kondisi_unit')->nullable();

            $table->string('ttd_customer')->nullable();
            $table->string('ttd_marketing')->nullable();

            $table->boolean('is_approved')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serah__terimas');
    }
};
