<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpr_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kpr_application_id'); // relasi ke KPR
            $table->string('type');    // jenis dokumen: slip_gaji, npwp, dll
            $table->string('path');    // path file di storage
            $table->timestamps();

            $table->foreign('kpr_application_id')
                  ->references('id')
                  ->on('kpr_applications')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpr_documents');
    }
};