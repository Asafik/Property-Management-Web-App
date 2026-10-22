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
        Schema::table('marketing_tasks', function (Blueprint $table) {
            $table->string('platform', 50)->nullable()->after('deskripsi');
            $table->text('link_postingan')->nullable()->after('platform');
            $table->text('catatan_setor')->nullable()->after('link_postingan');
            $table->timestamp('tanggal_setor')->nullable()->after('catatan_setor');
            $table->unsignedBigInteger('views')->default(0)->after('tanggal_setor');
            $table->unsignedInteger('likes')->default(0)->after('views');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketing_tasks', function (Blueprint $table) {
            $table->dropColumn([
                'platform',
                'link_postingan',
                'catatan_setor',
                'tanggal_setor',
                'views',
                'likes'
            ]);
        });
    }
};
