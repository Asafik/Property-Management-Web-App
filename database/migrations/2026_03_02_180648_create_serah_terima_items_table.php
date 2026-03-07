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
       Schema::create('serah_terima_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('serah_terima_id')->constrained()->cascadeOnDelete();

    $table->string('item_name');
    $table->boolean('is_checked')->default(false);
    $table->string('status')->nullable(); // OK / Perlu Perbaikan
    $table->text('keterangan')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serah_terima_items');
    }
};
