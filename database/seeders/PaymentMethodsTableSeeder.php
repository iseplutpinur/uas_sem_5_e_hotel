<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payment_methods')->delete();
        
        \DB::table('payment_methods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'logo' => 'e-hotel-1672426571.png',
                'name' => 'Bank Rakyat Indonesia',
                'number' => '20220919191044',
                'owner' => 'E-Hotel',
                'created_at' => '2022-12-31 01:56:11',
                'updated_at' => '2022-12-31 01:56:11',
            ),
        ));
        
        
    }
}