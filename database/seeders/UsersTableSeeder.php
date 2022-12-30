<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$YU8wBWFK3pL19hbcNCQpLO65zRumusblwPJ8clxtd8Z8rqHhoYh/G',
                'token' => 'MqzFIAd244f0xR8Mh0Ilkwnuw802AEmYIUVxotysvxiUQvMk6pbmIciW34puKn4W',
                'photo' => 'e-hotel-1672425571.jpg',
                'is_admin' => 1,
                'is_rent' => 0,
                'group_id' => 1,
                'remember_token' => 'RZYn1jdszCnDd6xNvj6aQ9j0ZKzy5pFi2OnZb2VByqeU6FRvhxJFHFP64tOs',
                'created_at' => '2022-12-31 01:38:24',
                'updated_at' => '2022-12-31 01:39:31',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Isep Lutpi Nur',
                'username' => NULL,
                'email' => 'iseplutpinur7@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$0nSjwNgTSYVQAwRqb3BobOg5pienee35hyqqrJjQ8XVFOlxw4E5VC',
                'token' => 'tNRXLOM5GAJ0ZIiCmNHmntXmDslBG6nHJyPsWxWT69LhhUHORDDwp4aeQOsep2BH',
                'photo' => NULL,
                'is_admin' => 0,
                'is_rent' => 1,
                'group_id' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-12-31 01:41:35',
                'updated_at' => '2022-12-31 01:56:22',
            ),
        ));
        
        
    }
}