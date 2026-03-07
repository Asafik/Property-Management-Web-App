<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('development_item_documents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('development_progress_item_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('file_path');
        $table->string('file_type')->nullable(); // photo / pdf
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('development_item_documents');
    }
};
