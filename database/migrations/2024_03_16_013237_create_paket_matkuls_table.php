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
        Schema::create('paket_matkuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')->references('id')->on('prodis');
            $table->string('nama_paket');
            $table->integer('semester');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_matkuls');
    }
};
