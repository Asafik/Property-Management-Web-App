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
       Schema::table('land_bank_units', function (Blueprint $table) {

    $table->integer('pos_x')->nullable();
    $table->integer('pos_y')->nullable();
    $table->integer('width')->nullable();
    $table->integer('height')->nullable();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('land_bank_units', function (Blueprint $table) {
            //
        });
    }
};
