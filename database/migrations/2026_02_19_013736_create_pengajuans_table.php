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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('marketing_id')
                ->constrained('employees')
                ->cascadeOnDelete();

            $table->enum('payment_method', [
                'cash_full',
                'cash_tempo',
                'kpr'
            ]);

            $table->bigInteger('unit_price');
            $table->bigInteger('down_payment')->nullable();

            // khusus cash tempo
            $table->integer('installment_duration')->nullable(); // dalam bulan
            $table->bigInteger('monthly_installment')->nullable();

            $table->enum('status', [
                'draft',
                'submitted',
                'approved',
                'rejected',
                'completed'
            ])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
