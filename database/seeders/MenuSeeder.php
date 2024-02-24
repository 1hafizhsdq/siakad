<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            ['menu' => 'Dashboard', 'url' => '/', 'parent_id' => null, 'sequence' => 1, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Data Master', 'url' => '#', 'parent_id' => null, 'sequence' => 2, 'icon' => '',  'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Role', 'url' => '/role', 'parent_id' => 2, 'sequence' => 1, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Fakultas', 'url' => '/fakultas', 'parent_id' => 2, 'sequence' => 2, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Ruangan', 'url' => '/ruangan', 'parent_id' => 2, 'sequence' => 3, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Tahun Ajaran', 'url' => '/tahun-ajaran', 'parent_id' => 2, 'sequence' => 4, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Program Studi', 'url' => '/prodi', 'parent_id' => 2, 'sequence' => 5, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Mata Kuliah', 'url' => '/matkul', 'parent_id' => 2, 'sequence' => 6, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Setting', 'url' => '#', 'parent_id' => null, 'sequence' => 9, 'icon' => '',  'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Menu', 'url' => '/menu', 'parent_id' => 9, 'sequence' => 1, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Role Menu', 'url' => '/role-menu', 'parent_id' => 9, 'sequence' => 2, 'icon' => '', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
