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
        Schema::create('pra_landbanks', function (Blueprint $table) {
            $table->id();

            // ===== BASIC LAND INFO =====
            $table->string('land_name')->nullable();
            $table->decimal('area', 12, 2)->nullable();
            $table->bigInteger('offer_price')->nullable();
            $table->bigInteger('estimated_price')->nullable();

            // ===== OWNER =====
            $table->string('land_owner')->nullable();
            $table->string('owner_contact')->nullable();

            // ===== SOURCE =====
            $table->string('land_source')->nullable();

            // ===== LOCATION =====
            $table->text('address')->nullable();
            $table->string('village')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();

            // ===== MAP =====
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();

            // ===== SURVEY =====
            $table->date('survey_date')->nullable();
            $table->string('survey_by')->nullable();
            $table->text('survey_result')->nullable();
            $table->string('land_status')->nullable();
            $table->string('water_condition')->nullable();
            $table->text('survey_notes')->nullable();

            // ===== ANALYSIS & LEGAL =====
            $table->string('zoning')->nullable();
            $table->integer('road_width')->nullable();
            $table->string('road_type')->nullable();
            $table->string('legal_status')->nullable();
            $table->text('legal_issue_note')->nullable();
            $table->string('permit_difficulty')->nullable();

            // ===== FACILITIES =====
            $table->boolean('facility_school')->default(false);
            $table->boolean('facility_hospital')->default(false);
            $table->boolean('facility_market')->default(false);
            $table->boolean('facility_transport')->default(false);
            $table->boolean('facility_mall')->default(false);
            $table->boolean('facility_bank')->default(false);

            // ===== FILE =====
            $table->string('file_certificate')->nullable();
            $table->string('photo')->nullable();

            // ===== APPROVAL =====
            $table->enum('status', [
                'pending',  // baru masuk, belum survey
                'fase1',   // input makelar
                'fase2',   // survey & validasi
                'fase3',   // keputusan
                'approved', // masuk landbank
                'rejected' // ditolak
            ])->default('pending');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('priority')->nullable();

            // ===== TRANSACTION / FINANCE (FASE 3) =====
            $table->bigInteger('cost_ijb')->nullable();
            $table->bigInteger('cost_tax')->nullable();
            $table->bigInteger('cost_broker')->nullable();
            $table->bigInteger('cost_other')->nullable();
            $table->string('file_ijb')->nullable();
            $table->string('file_tax')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('installment_duration')->nullable();
            $table->integer('installment_count')->nullable();

            // ===== NOTES =====
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pra_landbanks');
    }
};
