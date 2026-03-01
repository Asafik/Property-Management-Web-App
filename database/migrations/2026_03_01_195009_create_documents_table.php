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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama dokumen, contoh: KTP, NPWP
            $table->string('description')->nullable(); // Keterangan dokumen
            $table->boolean('required')->default(true); // Apakah wajib diupload
            $table->string('accept')->default('.jpg,.jpeg,.png,.pdf'); // Format file yang diterima
            $table->string('icon')->nullable(); // Class icon MDI, contoh: mdi-card-account-details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};