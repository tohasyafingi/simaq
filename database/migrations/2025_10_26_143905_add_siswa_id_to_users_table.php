<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom untuk guru_id, siswa_id, bendahara_id, tata_usaha_id
            $table->unsignedBigInteger('guru_id')->nullable()->after('id');
            $table->unsignedBigInteger('siswa_id')->nullable()->after('guru_id');
            $table->unsignedBigInteger('bendahara_id')->nullable()->after('siswa_id');
            $table->unsignedBigInteger('tata_usaha_id')->nullable()->after('bendahara_id');

            // Menambahkan foreign key untuk kolom yang baru
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('set null');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('set null');
            $table->foreign('bendahara_id')->references('id')->on('bendaharas')->onDelete('set null');
            $table->foreign('tata_usaha_id')->references('id')->on('tata_usahas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus foreign key dan kolom-kolom baru
            $table->dropForeign(['guru_id']);
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['bendahara_id']);
            $table->dropForeign(['tata_usaha_id']);

            // Menghapus kolom dari tabel users
            $table->dropColumn('guru_id');
            $table->dropColumn('siswa_id');
            $table->dropColumn('bendahara_id');
            $table->dropColumn('tata_usaha_id');
        });
    }
};
