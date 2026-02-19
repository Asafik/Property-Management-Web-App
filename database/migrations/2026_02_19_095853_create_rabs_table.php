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
       Schema::create('rabs', function (Blueprint $table) {
    $table->id();

    $table->string('no_rab')->unique();
    $table->date('tanggal');

  $table->foreignId('project_id')
      ->constrained('land_banks')
      ->cascadeOnDelete();
    $table->foreignId('unit_id')->constrained(
    'land_bank_units'
    )->cascadeOnDelete();

    // 🔥 RELASI KE PROGRESS
    $table->foreignId('progress_id')->constrained('development_progress')->cascadeOnDelete();

    $table->decimal('grand_total', 15,2)->default(0);
    $table->enum('status',['draft','acc','revisi'])->default('draft');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rabs');
    }
};
