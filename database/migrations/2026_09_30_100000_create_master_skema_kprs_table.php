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
        Schema::create('master_skema_kprs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->constrained('banks')->onDelete('cascade');
            $table->string('produk_kpr')->default('subsidi'); // subsidi, non_subsidi, syariah
            $table->string('nama_skema')->nullable(); // Misal: "KPR Sejahtera FLPP BTN"
            $table->integer('tenor'); // 5, 10, 15, 20 Tahun
            $table->decimal('bunga', 5, 2)->default(5.00); // 5.00 %
            $table->string('periode_tahun')->default('Flat Sepanjang Tenor'); // Misal: "Tahun 1 - 5", "Tahun 6 - 10", "Flat Sepanjang Tenor"
            $table->decimal('angsuran_per_bulan', 15, 0); // Nominal cicilan flat per bulan (Rp)
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_skema_kprs');
    }
};
