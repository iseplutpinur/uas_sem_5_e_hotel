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

        // admin
        // User::create([
        //     'name' => 'Admin',
        //     'username' => 'admin',
        //     'email' => 'admin@mail.com',
        //     'password' => Hash::make('admin'),
        //     'token' => Str::random(64),
        //     'is_admin' => true,
        //     'group_id' => '1'
        // ]);
        $this->call(GroupUsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(ForgotPasswordsTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);

        $this->call(BannersTableSeeder::class);
        $this->call(RoomCategoriesTableSeeder::class);
        $this->call(RoomCategoryImagesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(FacilitiesTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
    }
}

// php artisan iseed banners,facilities,failed_jobs,forgot_passwords,group_users,migrations,password_resets,payment_methods,personal_access_tokens,ratings,rooms,room_categories,room_category_images,transactions,users --force
