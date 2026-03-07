<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akads', function (Blueprint $table) {
            $table->id();

            // Relasi ke booking
            $table->foreignId('booking_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Data akad
            $table->string('no_akad')->unique();
            $table->date('tanggal_akad');

            // Dokumen upload (pdf / scan)
            $table->string('dokumen')->nullable();

            // Catatan tambahan
            $table->text('catatan')->nullable();

            // Status akad
            $table->enum('status', ['selesai', 'batal'])->default('selesai');

            // Jika batal
            $table->text('alasan_batal')->nullable();
            $table->enum('tindakan', ['refund', 'hangus'])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akads');
    }
};