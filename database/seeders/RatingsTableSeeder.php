<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ratings')->delete();
        
        \DB::table('ratings')->insert(array (
            0 => 
            array (
                'id' => 2,
                'transaction_id' => 1,
                'room_category_id' => 1,
                'user_id' => 2,
                'star' => 5,
                'created_at' => '2022-12-31 01:54:31',
                'updated_at' => '2022-12-31 01:54:31',
            ),
        ));
        
        
    }
}