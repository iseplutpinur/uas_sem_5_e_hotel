<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('room_categories')->delete();
        
        \DB::table('room_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Standard Room',
                'description' => 'Seperti namanya, jenis kamar standard room adalah tipe kamar hotel yang paling dasar di hotel.',
                'price' => 200000,
                'guest' => 10,
                'cover' => 'e-hotel-1672425794.jpg',
                'facility_id' => NULL,
                'created_at' => '2022-12-31 01:43:14',
                'updated_at' => '2022-12-31 01:43:14',
            ),
        ));
        
        
    }
}