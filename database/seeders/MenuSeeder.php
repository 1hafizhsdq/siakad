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
            ['menu' => 'Dashboard', 'url' => '/', 'parent_id' => null, 'sequence' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Data Master', 'url' => '#', 'parent_id' => null, 'sequence' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Menu', 'url' => '/menu', 'parent_id' => 2, 'sequence' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Role', 'url' => '/role', 'parent_id' => 2, 'sequence' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
