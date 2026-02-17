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
       Schema::create('customer_documents', function (Blueprint $table) {
    $table->id();
    $table->foreignId('customer_id')->constrained()->onDelete('cascade');

    $table->string('document_name')->nullable(); // contoh: KTP, KK, NPWP
    $table->string('document_number')->nullable();
    $table->string('file')->nullable(); // file upload
    $table->date('upload_date')->nullable();
    $table->enum('status',['Pending','Terverifikasi','Ditolak'])->default('Pending');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_documents');
    }
};
