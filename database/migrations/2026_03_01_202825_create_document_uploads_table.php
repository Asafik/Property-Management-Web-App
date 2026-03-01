<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id'); // relasi ke tabel documents
            $table->unsignedBigInteger('booking_id'); // relasi ke booking
            $table->string('file_name'); // nama file asli
            $table->string('file_path'); // path file di storage
            $table->timestamps();

            // Foreign key
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_uploads');
    }
};