<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('land_bank_documents', function (Blueprint $table) {
            $table->id();

            // Relation
            $table->foreignId('land_bank_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('document_type_id')
                  
                  ->constrained()
                  ->nullable()
                  ->cascadeOnDelete();

            // Document Detail
            $table->string('document_number')->nullable();
            $table->string('issuer')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();

            // File
            $table->string('file_path');

            // Verification
            $table->enum('status', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending');

            $table->text('admin_notes')->nullable();
            $table->unsignedInteger('revision_number')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('land_bank_documents');
    }
};