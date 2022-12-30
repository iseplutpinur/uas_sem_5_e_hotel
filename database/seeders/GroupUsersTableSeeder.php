<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GroupUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('group_users')->delete();
        
        \DB::table('group_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Master',
                '1_1' => 1,
                '1_2' => 1,
                '1_3' => 1,
                '1_4' => 1,
                '2_1' => 1,
                '2_2' => 1,
                '2_3' => 1,
                '2_4' => 1,
                '3_1' => 1,
                '3_2' => 1,
                '3_3' => 1,
                '3_4' => 1,
                '4_1' => 1,
                '4_2' => 1,
                '4_3' => 1,
                '4_4' => 1,
                '5_1' => 1,
                '5_2' => 1,
                '5_3' => 1,
                '5_4' => 1,
                '6_1' => 1,
                '6_2' => 1,
                '6_3' => 1,
                '6_4' => 1,
                '7_1' => 1,
                '7_2' => 1,
                '7_3' => 1,
                '7_4' => 1,
                '8_1' => 1,
                '8_2' => 1,
                '8_3' => 1,
                '8_4' => 1,
                '9_1' => 1,
                '9_2' => 1,
                '9_3' => 1,
                '9_4' => 1,
                '10_1' => 1,
                '10_2' => 1,
                '10_3' => 1,
                '10_4' => 1,
                '11_1' => 1,
                '11_2' => 1,
                '11_3' => 1,
                '11_4' => 1,
                '12_1' => 1,
                '12_2' => 1,
                '12_3' => 1,
                '12_4' => 1,
                '13_1' => 1,
                '13_2' => 1,
                '13_3' => 1,
                '13_4' => 1,
                'created_at' => '2022-12-31 01:38:24',
                'updated_at' => '2022-12-31 01:38:24',
            ),
        ));
        
        
    }
}