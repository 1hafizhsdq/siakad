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
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->foreign('dosen_id')->references('id')->on('users');
            $table->unsignedBigInteger('matkul_id');
            $table->foreign('matkul_id')->references('id')->on('matkuls');
            $table->unsignedBigInteger('jadwal_id');
            $table->foreign('jadwal_id')->references('id')->on('jadwal_kuliahs');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajarans');
            $table->unsignedBigInteger('jenis_perkuliahan_id');
            $table->foreign('jenis_perkuliahan_id')->references('id')->on('jenis_perkuliahans');
            $table->unsignedBigInteger('ruangan_id');
            $table->integer('pertemuan_ke');
            $table->date('tgl_pertemuan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->integer('sks');
            $table->string('lokasi')->nullable();
            $table->text('rencana_materi')->nullable();
            $table->text('realisasi_materi')->nullable();
            $table->integer('materi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuans');
    }
};
