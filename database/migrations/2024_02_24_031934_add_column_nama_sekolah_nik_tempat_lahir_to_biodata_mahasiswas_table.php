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
        Schema::table('biodata_mahasiswas', function (Blueprint $table) {
            $table->string('nik')->nullable()->after('user_id');
            $table->string('nama_sekolah')->nullable()->after('jenis_sekolah');
            $table->string('tempat_lahir_ayah')->nullable()->after('nama_ayah');
            $table->string('tempat_lahir_ibu')->nullable()->after('nama_ibu');
            $table->string('no_ijazah')->nullable()->after('ijazah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodata_mahasiswas', function (Blueprint $table) {
            //
        });
    }
};
