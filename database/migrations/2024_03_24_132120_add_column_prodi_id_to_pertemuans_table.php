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
        Schema::table('pertemuans', function (Blueprint $table) {
            $table->unsignedBigInteger('prodi_id')->after('id');
            $table->foreign('prodi_id')->references('id')->on('prodis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pertemuans', function (Blueprint $table) {
            //
        });
    }
};
