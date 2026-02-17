<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('development_progress_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('development_progress_id')
                  ->constrained('development_progress')
                  ->onDelete('cascade');

            // Untuk grouping section seperti:
            // I. Pekerjaan Persiapan
            // II. Pekerjaan Pondasi
            $table->enum('kategori', [
                'persiapan',
                'pondasi',
                'struktur',
                'dinding',
                'atap',
                'finishing',
                'lainnya'
            ]);

            $table->string('kode', 10); // contoh: 1.1, 1.2
            $table->string('uraian');
            $table->float('volume')->default(0);
            $table->string('satuan', 10);

            $table->bigInteger('harga_satuan')->default(0);
            $table->bigInteger('total')->default(0);

            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('development_progress_items');
    }
};
