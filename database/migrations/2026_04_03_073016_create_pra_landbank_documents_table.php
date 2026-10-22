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
        Schema::create('pra_landbank_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pra_landbank_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_type_id')->constrained('document_types')->cascadeOnDelete();

            $table->string('document_number')->nullable();
            $table->string('file_path')->nullable();

            $table->string('status')->default('pending');
            $table->integer('revision_number')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pra_landbank_documents');
    }
};
