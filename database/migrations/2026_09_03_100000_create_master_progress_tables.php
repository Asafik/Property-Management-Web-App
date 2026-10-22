<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_progress_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori'); // e.g. I. PERIZINAN & LEGALITAS
            $table->string('slug', 50)->unique(); // e.g. perizinan
            $table->string('prefix', 10)->default('1'); // e.g. P, 1, 2, 3
            $table->string('icon', 50)->default('folder-outline'); // e.g. file-certificate-outline
            $table->integer('urutan')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('master_progress_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_progress_category_id')
                  ->constrained('master_progress_categories')
                  ->onDelete('cascade');
            $table->string('kode', 20)->nullable(); // e.g. P.1, 1.1
            $table->string('uraian');
            $table->decimal('default_volume', 10, 2)->default(1);
            $table->string('satuan', 20)->default('ls');
            $table->bigInteger('default_harga_satuan')->default(0);
            $table->string('keterangan')->nullable();
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_progress_items');
        Schema::dropIfExists('master_progress_categories');
    }
};
