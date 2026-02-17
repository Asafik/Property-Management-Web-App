<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_materials', function (Blueprint $table) {
            $table->id();

            // Relasi ke unit
            $table->foreignId('unit_id')
                  ->constrained('land_bank_units')
                  ->onDelete('cascade');

            $table->string('name'); // Nama bahan baku, contoh: Semen
            $table->integer('quantity')->nullable(); // jumlah atau volume
            $table->string('unit')->nullable(); // satuan, contoh: kg, sak
            $table->text('notes')->nullable(); // keterangan tambahan
            $table->enum('status', ['pending', 'ready', 'used'])->default('pending'); // status bahan

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_materials');
    }
};
