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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('agama_id')->default(1)->after('tgl_lahir')->nullable();
            $table->string('nidn')->nullable()->after('no_induk');
            $table->string('gelar_depan')->nullable()->after('tgl_lahir');
            $table->string('gelar_belakang')->nullable()->after('gelar_depan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
