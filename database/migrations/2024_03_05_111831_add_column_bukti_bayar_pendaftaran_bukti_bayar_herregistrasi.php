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
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('bukti_bayar_pendaftaran')->after('prodi_id')->nullable();
            $table->string('bukti_bayar_herregistrasi')->after('bukti_bayar_pendaftaran')->nullable();
            $table->string('keterangan')->after('bukti_bayar_herregistrasi')->nullable();
            $table->integer('status')->nullable()->comment('1=Baru;2=Daftar Ulang;3=Ditolak;4=perbaikan')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            //
        });
    }
};
