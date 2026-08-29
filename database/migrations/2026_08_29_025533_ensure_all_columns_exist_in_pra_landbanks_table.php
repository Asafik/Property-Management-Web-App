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
        Schema::table('pra_landbanks', function (Blueprint $table) {
            if (!Schema::hasColumn('pra_landbanks', 'land_status')) {
                $table->string('land_status')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'water_condition')) {
                $table->string('water_condition')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'survey_notes')) {
                $table->text('survey_notes')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'legal_status')) {
                $table->string('legal_status')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'legal_issue_note')) {
                $table->text('legal_issue_note')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'permit_difficulty')) {
                $table->string('permit_difficulty')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'permit_difficulty_note')) {
                $table->text('permit_difficulty_note')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'facility_mall')) {
                $table->boolean('facility_mall')->default(false);
            }
            if (!Schema::hasColumn('pra_landbanks', 'facility_bank')) {
                $table->boolean('facility_bank')->default(false);
            }
            if (!Schema::hasColumn('pra_landbanks', 'priority')) {
                $table->string('priority')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'cost_ijb')) {
                $table->decimal('cost_ijb', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'cost_tax')) {
                $table->decimal('cost_tax', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'cost_broker')) {
                $table->decimal('cost_broker', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'cost_other')) {
                $table->decimal('cost_other', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'file_ijb')) {
                $table->string('file_ijb')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'file_tax')) {
                $table->string('file_tax')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'payment_method')) {
                $table->string('payment_method')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'installment_duration')) {
                $table->integer('installment_duration')->nullable();
            }
            if (!Schema::hasColumn('pra_landbanks', 'installment_count')) {
                $table->integer('installment_count')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep columns safe
    }
};
