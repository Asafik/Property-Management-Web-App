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
    Schema::create('guests', function (Blueprint $table) {
    $table->id();

    $table->string('name');
    $table->string('phone')->nullable();
    $table->string('email')->nullable();

    $table->string('source')->nullable();
    $table->foreignId('land_bank_id')
      ->nullable()
      ->constrained('land_banks')
      ->nullOnDelete();
       $table->foreignId('unit_id')
      ->nullable()
      ->constrained('land_bank_units')
      ->nullOnDelete();
    $table->text('notes')->nullable();

    $table->enum('status', [
        'new',
        'follow_up',
        'negotiation',
        'lost',
        'converted'
    ])->default('new');

    $table->foreignId('assigned_to')
          ->nullable()
          ->constrained('employees')
          ->nullOnDelete();

    $table->timestamp('last_follow_up')->nullable();
    $table->timestamp('next_follow_up')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
