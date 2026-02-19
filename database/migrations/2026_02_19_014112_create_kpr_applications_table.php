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
        Schema::create('kpr_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_id')
                ->constrained('pengajuan')
                ->cascadeOnDelete();

            $table->string('bank_name');
            $table->string('loan_product')->nullable();

            $table->bigInteger('loan_amount');
            $table->integer('tenor_years');
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->bigInteger('estimated_installment')->nullable();

            $table->string('employment_status')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpr_applications');
    }
};
