<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_tempos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();

            // Harga unit
            $table->bigInteger('harga_unit');
            $table->bigInteger('diskon')->default(0);
            $table->bigInteger('booking_fee')->default(0);

            // Pembayaran
            $table->bigInteger('dp');
            $table->bigInteger('sisa_pembayaran');

            // Tenor
            $table->integer('tenor_bulan');
            $table->date('tanggal_mulai_angsuran');
            $table->date('tanggal_jatuh_tempo_akhir');

            // Denda
            $table->decimal('denda_persen',5,2)->default(0);

            // Metode pembayaran
            $table->enum('metode_pembayaran', ['transfer','cash','giro']);

            // Status pembayaran
            $table->enum('status',[
                'draft',
                'process',
                'lunas',
                'cancel'
            ])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_tempos');
    }
};