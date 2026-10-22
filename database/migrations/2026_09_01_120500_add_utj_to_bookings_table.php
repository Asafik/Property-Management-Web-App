<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'utj')) {
                $table->bigInteger('utj')->nullable()->after('booking_fee')->comment('Nominal Uang Tanda Jadi (UTJ) - Tidak mengurangi harga jual unit');
            }
        });

        // Sinkronkan data yang sudah ada dari booking_fee ke utj
        DB::statement("UPDATE bookings SET utj = booking_fee WHERE utj IS NULL AND booking_fee IS NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'utj')) {
                $table->dropColumn('utj');
            }
        });
    }
};
