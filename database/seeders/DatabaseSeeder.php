<?php

namespace Database\Seeders;

use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        GroupUser::create([
            'name' => 'Master',
            '1_1' => true,
            '1_2' => true,
            '1_3' => true,
            '1_4' => true,
            '2_1' => true,
            '2_2' => true,
            '2_3' => true,
            '2_4' => true,
            '3_1' => true,
            '3_2' => true,
            '3_3' => true,
            '3_4' => true,
            '4_1' => true,
            '4_2' => true,
            '4_3' => true,
            '4_4' => true,
            '5_1' => true,
            '5_2' => true,
            '5_3' => true,
            '5_4' => true,
            '6_1' => true,
            '6_2' => true,
            '6_3' => true,
            '6_4' => true,
            '7_1' => true,
            '7_2' => true,
            '7_3' => true,
            '7_4' => true,
            '8_1' => true,
            '8_2' => true,
            '8_3' => true,
            '8_4' => true,
            '9_1' => true,
            '9_2' => true,
            '9_3' => true,
            '9_4' => true,
            '10_1' => true,
            '10_2' => true,
            '10_3' => true,
            '10_4' => true,
            '11_1' => true,
            '11_2' => true,
            '11_3' => true,
            '11_4' => true,
            '12_1' => true,
            '12_2' => true,
            '12_3' => true,
            '12_4' => true,
            '13_1' => true,
            '13_2' => true,
            '13_3' => true,
            '13_4' => true
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'token' => Str::random(64),
            'is_admin' => true,
            'group_id' => '1'
        ]);
    }
}
