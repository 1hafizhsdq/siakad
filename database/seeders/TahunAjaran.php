<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaran extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahun_ajarans')->insert([
            [
                'nama_tahun_ajaran' => '2024/2025',
                'semester' => 'gasal',
                'is_active' => 1,
            ],
        ]);
    }
}
