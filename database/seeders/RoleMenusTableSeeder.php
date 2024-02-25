<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_menus')->delete();
        
        \DB::table('role_menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'menu_id' => 1,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:14:13',
                'updated_at' => '2024-02-24 09:14:13',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 2,
                'menu_id' => 1,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:14:13',
                'updated_at' => '2024-02-24 09:14:13',
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 3,
                'menu_id' => 1,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:14:13',
                'updated_at' => '2024-02-24 09:14:13',
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 4,
                'menu_id' => 1,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:14:13',
                'updated_at' => '2024-02-24 09:14:13',
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => 5,
                'menu_id' => 1,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:14:13',
                'updated_at' => '2024-02-24 09:14:13',
            ),
            5 => 
            array (
                'id' => 6,
                'role_id' => 1,
                'menu_id' => 2,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:21',
                'updated_at' => '2024-02-24 09:15:21',
            ),
            6 => 
            array (
                'id' => 7,
                'role_id' => 2,
                'menu_id' => 2,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:21',
                'updated_at' => '2024-02-24 09:15:21',
            ),
            7 => 
            array (
                'id' => 8,
                'role_id' => 3,
                'menu_id' => 2,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:21',
                'updated_at' => '2024-02-24 09:15:21',
            ),
            8 => 
            array (
                'id' => 9,
                'role_id' => 4,
                'menu_id' => 2,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:21',
                'updated_at' => '2024-02-24 09:15:21',
            ),
            9 => 
            array (
                'id' => 10,
                'role_id' => 5,
                'menu_id' => 2,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:21',
                'updated_at' => '2024-02-24 09:15:21',
            ),
            10 => 
            array (
                'id' => 11,
                'role_id' => 1,
                'menu_id' => 3,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:28',
                'updated_at' => '2024-02-24 09:15:28',
            ),
            11 => 
            array (
                'id' => 12,
                'role_id' => 2,
                'menu_id' => 3,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:28',
                'updated_at' => '2024-02-24 09:15:28',
            ),
            12 => 
            array (
                'id' => 13,
                'role_id' => 3,
                'menu_id' => 3,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:28',
                'updated_at' => '2024-02-24 09:15:28',
            ),
            13 => 
            array (
                'id' => 14,
                'role_id' => 4,
                'menu_id' => 3,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:28',
                'updated_at' => '2024-02-24 09:15:28',
            ),
            14 => 
            array (
                'id' => 15,
                'role_id' => 5,
                'menu_id' => 3,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:28',
                'updated_at' => '2024-02-24 09:15:28',
            ),
            15 => 
            array (
                'id' => 16,
                'role_id' => 1,
                'menu_id' => 4,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:34',
                'updated_at' => '2024-02-24 09:15:34',
            ),
            16 => 
            array (
                'id' => 17,
                'role_id' => 2,
                'menu_id' => 4,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:34',
                'updated_at' => '2024-02-24 09:15:34',
            ),
            17 => 
            array (
                'id' => 18,
                'role_id' => 3,
                'menu_id' => 4,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:34',
                'updated_at' => '2024-02-24 09:15:34',
            ),
            18 => 
            array (
                'id' => 19,
                'role_id' => 4,
                'menu_id' => 4,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:34',
                'updated_at' => '2024-02-24 09:15:34',
            ),
            19 => 
            array (
                'id' => 20,
                'role_id' => 5,
                'menu_id' => 4,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:34',
                'updated_at' => '2024-02-24 09:15:34',
            ),
            20 => 
            array (
                'id' => 21,
                'role_id' => 1,
                'menu_id' => 5,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:43',
                'updated_at' => '2024-02-24 09:15:43',
            ),
            21 => 
            array (
                'id' => 22,
                'role_id' => 2,
                'menu_id' => 5,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:43',
                'updated_at' => '2024-02-24 09:15:43',
            ),
            22 => 
            array (
                'id' => 23,
                'role_id' => 3,
                'menu_id' => 5,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:43',
                'updated_at' => '2024-02-24 09:15:43',
            ),
            23 => 
            array (
                'id' => 24,
                'role_id' => 4,
                'menu_id' => 5,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:43',
                'updated_at' => '2024-02-24 09:15:43',
            ),
            24 => 
            array (
                'id' => 25,
                'role_id' => 5,
                'menu_id' => 5,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:43',
                'updated_at' => '2024-02-24 09:15:43',
            ),
            25 => 
            array (
                'id' => 26,
                'role_id' => 1,
                'menu_id' => 6,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:48',
                'updated_at' => '2024-02-24 09:15:48',
            ),
            26 => 
            array (
                'id' => 27,
                'role_id' => 2,
                'menu_id' => 6,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:48',
                'updated_at' => '2024-02-24 09:15:48',
            ),
            27 => 
            array (
                'id' => 28,
                'role_id' => 3,
                'menu_id' => 6,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:48',
                'updated_at' => '2024-02-24 09:15:48',
            ),
            28 => 
            array (
                'id' => 29,
                'role_id' => 4,
                'menu_id' => 6,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:48',
                'updated_at' => '2024-02-24 09:15:48',
            ),
            29 => 
            array (
                'id' => 30,
                'role_id' => 5,
                'menu_id' => 6,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:48',
                'updated_at' => '2024-02-24 09:15:48',
            ),
            30 => 
            array (
                'id' => 31,
                'role_id' => 1,
                'menu_id' => 7,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:52',
                'updated_at' => '2024-02-24 09:15:52',
            ),
            31 => 
            array (
                'id' => 32,
                'role_id' => 2,
                'menu_id' => 7,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:52',
                'updated_at' => '2024-02-24 09:15:52',
            ),
            32 => 
            array (
                'id' => 33,
                'role_id' => 3,
                'menu_id' => 7,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:52',
                'updated_at' => '2024-02-24 09:15:52',
            ),
            33 => 
            array (
                'id' => 34,
                'role_id' => 4,
                'menu_id' => 7,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:52',
                'updated_at' => '2024-02-24 09:15:52',
            ),
            34 => 
            array (
                'id' => 35,
                'role_id' => 5,
                'menu_id' => 7,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:52',
                'updated_at' => '2024-02-24 09:15:52',
            ),
            35 => 
            array (
                'id' => 36,
                'role_id' => 1,
                'menu_id' => 8,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:58',
                'updated_at' => '2024-02-24 09:15:58',
            ),
            36 => 
            array (
                'id' => 37,
                'role_id' => 2,
                'menu_id' => 8,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:15:58',
                'updated_at' => '2024-02-24 09:15:58',
            ),
            37 => 
            array (
                'id' => 38,
                'role_id' => 3,
                'menu_id' => 8,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:58',
                'updated_at' => '2024-02-24 09:15:58',
            ),
            38 => 
            array (
                'id' => 39,
                'role_id' => 4,
                'menu_id' => 8,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:58',
                'updated_at' => '2024-02-24 09:15:58',
            ),
            39 => 
            array (
                'id' => 40,
                'role_id' => 5,
                'menu_id' => 8,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:15:58',
                'updated_at' => '2024-02-24 09:15:58',
            ),
            40 => 
            array (
                'id' => 41,
                'role_id' => 1,
                'menu_id' => 9,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:16:03',
                'updated_at' => '2024-02-24 09:16:03',
            ),
            41 => 
            array (
                'id' => 42,
                'role_id' => 2,
                'menu_id' => 9,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:16:03',
                'updated_at' => '2024-02-24 09:16:03',
            ),
            42 => 
            array (
                'id' => 43,
                'role_id' => 3,
                'menu_id' => 9,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:03',
                'updated_at' => '2024-02-24 09:16:03',
            ),
            43 => 
            array (
                'id' => 44,
                'role_id' => 4,
                'menu_id' => 9,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:03',
                'updated_at' => '2024-02-24 09:16:03',
            ),
            44 => 
            array (
                'id' => 45,
                'role_id' => 5,
                'menu_id' => 9,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:03',
                'updated_at' => '2024-02-24 09:16:03',
            ),
            45 => 
            array (
                'id' => 46,
                'role_id' => 1,
                'menu_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:16:09',
                'updated_at' => '2024-02-24 09:16:09',
            ),
            46 => 
            array (
                'id' => 47,
                'role_id' => 2,
                'menu_id' => 10,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:09',
                'updated_at' => '2024-02-24 23:29:48',
            ),
            47 => 
            array (
                'id' => 48,
                'role_id' => 3,
                'menu_id' => 10,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:09',
                'updated_at' => '2024-02-24 09:16:09',
            ),
            48 => 
            array (
                'id' => 49,
                'role_id' => 4,
                'menu_id' => 10,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:09',
                'updated_at' => '2024-02-24 09:16:09',
            ),
            49 => 
            array (
                'id' => 50,
                'role_id' => 5,
                'menu_id' => 10,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:09',
                'updated_at' => '2024-02-24 09:16:09',
            ),
            50 => 
            array (
                'id' => 51,
                'role_id' => 1,
                'menu_id' => 11,
                'is_active' => 1,
                'created_at' => '2024-02-24 09:16:13',
                'updated_at' => '2024-02-24 09:16:13',
            ),
            51 => 
            array (
                'id' => 52,
                'role_id' => 2,
                'menu_id' => 11,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:13',
                'updated_at' => '2024-02-24 23:29:52',
            ),
            52 => 
            array (
                'id' => 53,
                'role_id' => 3,
                'menu_id' => 11,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:13',
                'updated_at' => '2024-02-24 09:16:13',
            ),
            53 => 
            array (
                'id' => 54,
                'role_id' => 4,
                'menu_id' => 11,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:13',
                'updated_at' => '2024-02-24 09:16:13',
            ),
            54 => 
            array (
                'id' => 55,
                'role_id' => 5,
                'menu_id' => 11,
                'is_active' => NULL,
                'created_at' => '2024-02-24 09:16:13',
                'updated_at' => '2024-02-24 09:16:13',
            ),
            55 => 
            array (
                'id' => 56,
                'role_id' => 1,
                'menu_id' => 12,
                'is_active' => 1,
                'created_at' => '2024-02-24 23:38:13',
                'updated_at' => '2024-02-24 23:38:13',
            ),
            56 => 
            array (
                'id' => 57,
                'role_id' => 2,
                'menu_id' => 12,
                'is_active' => 1,
                'created_at' => '2024-02-24 23:38:13',
                'updated_at' => '2024-02-24 23:38:13',
            ),
            57 => 
            array (
                'id' => 58,
                'role_id' => 3,
                'menu_id' => 12,
                'is_active' => NULL,
                'created_at' => '2024-02-24 23:38:13',
                'updated_at' => '2024-02-24 23:38:13',
            ),
            58 => 
            array (
                'id' => 59,
                'role_id' => 4,
                'menu_id' => 12,
                'is_active' => NULL,
                'created_at' => '2024-02-24 23:38:13',
                'updated_at' => '2024-02-24 23:38:13',
            ),
            59 => 
            array (
                'id' => 60,
                'role_id' => 5,
                'menu_id' => 12,
                'is_active' => NULL,
                'created_at' => '2024-02-24 23:38:13',
                'updated_at' => '2024-02-24 23:38:13',
            ),
            60 => 
            array (
                'id' => 61,
                'role_id' => 1,
                'menu_id' => 13,
                'is_active' => 1,
                'created_at' => '2024-02-24 23:38:19',
                'updated_at' => '2024-02-24 23:38:19',
            ),
            61 => 
            array (
                'id' => 62,
                'role_id' => 2,
                'menu_id' => 13,
                'is_active' => 1,
                'created_at' => '2024-02-24 23:38:19',
                'updated_at' => '2024-02-24 23:38:19',
            ),
            62 => 
            array (
                'id' => 63,
                'role_id' => 3,
                'menu_id' => 13,
                'is_active' => NULL,
                'created_at' => '2024-02-24 23:38:19',
                'updated_at' => '2024-02-24 23:38:19',
            ),
            63 => 
            array (
                'id' => 64,
                'role_id' => 4,
                'menu_id' => 13,
                'is_active' => NULL,
                'created_at' => '2024-02-24 23:38:19',
                'updated_at' => '2024-02-24 23:38:19',
            ),
            64 => 
            array (
                'id' => 65,
                'role_id' => 5,
                'menu_id' => 13,
                'is_active' => NULL,
                'created_at' => '2024-02-24 23:38:19',
                'updated_at' => '2024-02-24 23:38:19',
            ),
        ));
        
        
    }
}