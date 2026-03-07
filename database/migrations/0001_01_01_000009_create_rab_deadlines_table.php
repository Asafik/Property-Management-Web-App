
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
    Schema::create('rab_deadlines', function (Blueprint $table) {
        $table->id();

        $table->foreignId('development_progress_id')
            ->constrained('development_progress')
            ->onDelete('cascade');

        $table->date('target_mulai');
        $table->date('target_selesai');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rab_deadlines');
    }
};
