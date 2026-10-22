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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('category')->default('pra_landbank'); // pra_landbank, unit_cash, unit_kpr, operasional, dll.
            $table->unsignedBigInteger('pra_landbank_id')->nullable()->index();
            $table->unsignedBigInteger('booking_id')->nullable()->index();
            $table->string('title');
            $table->string('recipient_name')->nullable();
            $table->string('recipient_contact')->nullable();
            $table->decimal('total_amount', 18, 2)->default(0);
            $table->decimal('paid_amount', 18, 2)->default(0);
            $table->decimal('remaining_amount', 18, 2)->default(0);
            $table->string('payment_method')->default('cash'); // cash, termin, transfer, etc.
            $table->string('payment_status')->default('pending'); // pending, partial, lunas, cancelled
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('pra_landbank_id')->references('id')->on('pra_landbanks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
