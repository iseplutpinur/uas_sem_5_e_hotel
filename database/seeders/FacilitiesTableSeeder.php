<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facilities')->delete();
        
        \DB::table('facilities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'icon' => 'fas fa-phone',
                'name' => 'Telepon',
                'price' => 5000,
                'is_addon' => 1,
                'created_at' => '2022-12-31 01:44:58',
                'updated_at' => '2022-12-31 01:44:58',
            ),
        ));
        
        
    }
}