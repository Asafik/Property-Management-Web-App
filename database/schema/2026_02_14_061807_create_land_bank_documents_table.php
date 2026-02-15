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
        Schema::create('land_bank_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_bank_id')->constrained()->onDelete('cascade');
            $table->string('type'); // sertifikat, imb, pbb, siteplan, foto
            $table->string('file_path');
            $table->string('document_number')->nullable();
            $table->enum('status', ['pending', 'terverifikasi', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->integer('revisi_ke')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_bank_documents');
    }
};
