<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('development_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('land_bank_unit_id')
                  ->constrained('land_bank_units')
                  ->onDelete('cascade');

            $table->string('title')->nullable(); // misal: Progress Tahap 1
            $table->enum('status', ['draft', 'ongoing', 'completed'])
                  ->default('draft');

            $table->bigInteger('total_anggaran')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('development_progress');
    }
};
