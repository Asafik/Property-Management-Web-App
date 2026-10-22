<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_tempo_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cash_tempo_id')->constrained()->cascadeOnDelete();

            $table->string('ktp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('surat_perjanjian')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_tempo_documents');
    }
};