<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // RELASI KE BOOKING
            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            // JENIS PEMBAYARAN
            $table->enum('type', [
                'booking_fee',
                'dp',
                'cicilan',
                'pelunasan'
            ]);

            $table->bigInteger('amount');
            $table->date('payment_date')->nullable();

            $table->string('method')->nullable(); // transfer, cash, dll
            $table->string('reference_number')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};