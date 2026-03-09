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
            $table->decimal('area', 12,2)->nullable();
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
            $table->decimal('lat',10,8)->nullable();
            $table->decimal('lng',11,8)->nullable();

            // ===== SURVEY =====
            $table->date('survey_date')->nullable();
            $table->string('survey_by')->nullable();
            $table->text('survey_result')->nullable();

            // ===== ANALYSIS =====
            $table->string('zoning')->nullable();
            $table->integer('road_width')->nullable();
            $table->string('road_type')->nullable();

            // ===== FACILITIES =====
            $table->boolean('facility_school')->default(false);
            $table->boolean('facility_hospital')->default(false);
            $table->boolean('facility_market')->default(false);
            $table->boolean('facility_transport')->default(false);

            // ===== FILE =====
            $table->string('file_certificate')->nullable();
            $table->string('photo')->nullable();

            // ===== APPROVAL =====
            $table->enum('status', ['draft','survey','review','approved','rejected'])
                  ->default('draft');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();

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