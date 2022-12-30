<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transactions')->delete();
        
        \DB::table('transactions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'room_category_id' => 1,
                'payment_method_id' => 1,
                'room_id' => 2,
                'number' => 'INV-1672425931',
                'check_in' => '2022-12-31',
                'check_out' => '2023-01-01',
                'guest' => 1,
                'status' => 'active',
                'payment_slip' => 'e-hotel-1672426616.jpg',
                'facility_id' => '["1"]',
                'is_rated' => 1,
                'created_at' => '2022-12-31 01:45:31',
                'updated_at' => '2022-12-31 01:57:07',
            ),
        ));
        
        
    }
}