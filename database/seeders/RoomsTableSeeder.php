<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rooms')->delete();
        
        \DB::table('rooms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'room_category_id' => 1,
                'number' => 1,
                'floor' => 1,
                'is_available' => 0,
                'created_at' => '2022-12-31 01:43:59',
                'updated_at' => '2022-12-31 01:47:51',
            ),
            1 => 
            array (
                'id' => 2,
                'room_category_id' => 1,
                'number' => 2,
                'floor' => 1,
                'is_available' => 1,
                'created_at' => '2022-12-31 01:44:10',
                'updated_at' => '2022-12-31 01:47:51',
            ),
        ));
        
        
    }
}