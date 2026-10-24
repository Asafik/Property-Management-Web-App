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
        // 1. Kolom tambahan pada tabel bookings untuk skema pembayaran UTJ
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'utj_payment_type')) {
                $table->string('utj_payment_type', 20)->default('lunas')->after('utj')->comment('lunas atau cicilan');
            }
            if (!Schema::hasColumn('bookings', 'sisa_utj')) {
                $table->bigInteger('sisa_utj')->default(0)->after('utj_payment_type')->comment('Sisa UTJ yang masih harus dibayar/dicicil');
            }
        });

        // 2. Tabel rincian jadwal cicilan sisa UTJ
        if (!Schema::hasTable('booking_utj_installments')) {
            Schema::create('booking_utj_installments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
                $table->unsignedInteger('installment_number')->default(1);
                $table->bigInteger('amount')->default(0);
                $table->date('due_date')->nullable();
                $table->enum('status', ['pending', 'paid'])->default('pending');
                $table->date('payment_date')->nullable();
                $table->string('payment_method')->nullable();
                $table->string('proof_file')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_utj_installments');

        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'sisa_utj')) {
                $table->dropColumn('sisa_utj');
            }
            if (Schema::hasColumn('bookings', 'utj_payment_type')) {
                $table->dropColumn('utj_payment_type');
            }
        });
    }
};
