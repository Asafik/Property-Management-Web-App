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
        Schema::create('land_bank_infrastructures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_bank_id')->constrained('land_banks')->onDelete('cascade');
            $table->string('item_name');
            $table->string('category')->default('Infrastruktur');
            $table->string('volume')->nullable();
            $table->decimal('bobot_persen', 5, 2)->default(0);
            $table->decimal('progress_percent', 5, 2)->default(0);
            $table->string('status')->default('belum_mulai'); // belum_mulai, proses, selesai
            $table->date('target_start')->nullable();
            $table->date('target_end')->nullable();
            $table->string('contractor_name')->nullable();
            $table->decimal('cost_estimate', 15, 2)->nullable();
            $table->string('photo_proof')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_bank_infrastructures');
    }
};
