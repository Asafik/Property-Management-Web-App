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
        Schema::create('pra_landbank_payments', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke pra_landbanks
            $table->foreignId('pra_landbank_id')
                ->constrained('pra_landbanks')
                ->cascadeOnDelete();
                
            $table->string('term_name'); // DP / Tahap 1, Tahap 2, dll
            $table->bigInteger('amount'); // Nominal
            $table->date('due_date')->nullable(); // Jatuh tempo
            $table->string('file_path')->nullable(); // Bukti Transfer / Kuitansi
            $table->enum('status', ['belum', 'lunas'])->default('belum'); // Status

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pra_landbank_payments');
    }
};
