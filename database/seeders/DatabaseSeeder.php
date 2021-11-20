<?php

namespace Database\Seeders;

use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'is_admin' => true,
            'group_id' => '1'
        ]);

        GroupUser::create([
            'name' => 'Master'
        ]);
    }
}
