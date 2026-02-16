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
        Schema::create('land_bank_units', function (Blueprint $table) {
            $table->id();

            // relasi ke tanah induk
            $table->foreignId('land_bank_id')
                  ->constrained('land_banks')
                  ->onDelete('cascade');

            // ===== IDENTITAS UNIT =====
            $table->string('block')->nullable(); // A
            $table->string('unit_number')->nullable(); // 1
            $table->string('unit_code')->unique(); // A.1

            // ===== DATA KAVLING =====
            $table->float('area'); // luas kavling
            $table->bigInteger('price')->nullable();

            $table->enum('facing', ['Utara','Selatan','Timur','Barat'])->nullable();
            $table->enum('position', ['Hook','Tengah','Sudut'])->nullable();

            $table->text('description')->nullable();

            // ===== STATUS =====
            $table->enum('status', [
                'draft',
                'ready',
                'booked',
                'sold'
            ])->default('draft');

            // ===== PROGRESS PEMBANGUNAN =====
            $table->enum('construction_progress', [
                'belum_mulai',    
                'pondasi',        
                'dinding',       
                'atap',           
                'finishing',      
                'selesai'         
            ])->default('belum_mulai');

            // ===== POSISI DENAH (opsional siteplan grid) =====
            $table->integer('x')->nullable();
            $table->integer('y')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_bank_units');
    }
};
