<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_tempo_installments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cash_tempo_id')->constrained()->cascadeOnDelete();

            $table->integer('bulan_ke');

            $table->date('jatuh_tempo');

            $table->bigInteger('nominal_angsuran');

            $table->bigInteger('sisa_pokok');

            $table->enum('status',[
                'pending',
                'paid',
                'late'
            ])->default('pending');

            $table->date('tanggal_bayar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_tempo_installments');
    }
};