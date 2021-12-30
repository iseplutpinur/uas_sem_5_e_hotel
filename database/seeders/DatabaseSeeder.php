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
            'name' => 'Master'
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
