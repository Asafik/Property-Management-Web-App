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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');

            $table->enum('validity_period', ['selalu', 'periode']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('duration_days')->nullable(); // ← TAMBAHKAN INI

            $table->enum('type', ['persen', 'nominal']);
            $table->enum('category', ['promo', 'biaya', 'fasilitas']);

            $table->decimal('value', 15, 2); // ← lebih baik decimal, jangan string
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
