<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI
            |--------------------------------------------------------------------------
            */

            $table->foreignId('unit_id')
                ->constrained('land_bank_units')
                ->cascadeOnDelete();

            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('sales_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | DATA BOOKING
            |--------------------------------------------------------------------------
            */

            $table->string('booking_code')->unique();
            $table->bigInteger('booking_fee')->nullable();
            $table->date('booking_date')->nullable();

            /*
            |--------------------------------------------------------------------------
            | METODE PEMBELIAN
            |--------------------------------------------------------------------------
            */

            $table->enum('purchase_type', ['cash', 'kpr']);

            /*
            |--------------------------------------------------------------------------
            | STATUS BOOKING
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'active',        // sedang dibooking
                'cancelled',     // batal
                'lanjut_kpr',    // lanjut proses KPR
                'cash_process',  // proses cash bertahap
                'akad',          // sudah akad
                'completed'      // selesai/lunas
            ])->default('active');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};