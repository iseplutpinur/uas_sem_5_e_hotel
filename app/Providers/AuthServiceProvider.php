<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function (User $user) {
            return $user->is_admin === true;
        });

        Gate::define('1_1', function (User $user) {
            return $user->group->{'1_1'} === true;
        });
        Gate::define('1_2', function (User $user) {
            return $user->group->{'1_2'} === true;
        });
        Gate::define('1_3', function (User $user) {
            return $user->group->{'1_3'} === true;
        });
        Gate::define('1_4', function (User $user) {
            return $user->group->{'1_4'} === true;
        });

        Gate::define('2_1', function (User $user) {
            return $user->group->{'2_1'} === true;
        });
        Gate::define('2_2', function (User $user) {
            return $user->group->{'2_2'} === true;
        });
        Gate::define('2_3', function (User $user) {
            return $user->group->{'2_3'} === true;
        });
        Gate::define('2_4', function (User $user) {
            return $user->group->{'2_4'} === true;
        });

        Gate::define('3_1', function (User $user) {
            return $user->group->{'3_1'} === true;
        });
        Gate::define('3_2', function (User $user) {
            return $user->group->{'3_2'} === true;
        });
        Gate::define('3_3', function (User $user) {
            return $user->group->{'3_3'} === true;
        });
        Gate::define('3_4', function (User $user) {
            return $user->group->{'3_4'} === true;
        });

        Gate::define('4_1', function (User $user) {
            return $user->group->{'4_1'} === true;
        });
        Gate::define('4_2', function (User $user) {
            return $user->group->{'4_2'} === true;
        });
        Gate::define('4_3', function (User $user) {
            return $user->group->{'4_3'} === true;
        });
        Gate::define('4_4', function (User $user) {
            return $user->group->{'4_4'} === true;
        });

        Gate::define('5_1', function (User $user) {
            return $user->group->{'5_1'} === true;
        });
        Gate::define('5_2', function (User $user) {
            return $user->group->{'5_2'} === true;
        });
        Gate::define('5_3', function (User $user) {
            return $user->group->{'5_3'} === true;
        });
        Gate::define('5_4', function (User $user) {
            return $user->group->{'5_4'} === true;
        });

        Gate::define('6_1', function (User $user) {
            return $user->group->{'6_1'} === true;
        });
        Gate::define('6_2', function (User $user) {
            return $user->group->{'6_2'} === true;
        });
        Gate::define('6_3', function (User $user) {
            return $user->group->{'6_3'} === true;
        });
        Gate::define('6_4', function (User $user) {
            return $user->group->{'6_4'} === true;
        });

        Gate::define('7_1', function (User $user) {
            return $user->group->{'7_1'} === true;
        });
        Gate::define('7_2', function (User $user) {
            return $user->group->{'7_2'} === true;
        });
        Gate::define('7_3', function (User $user) {
            return $user->group->{'7_3'} === true;
        });
        Gate::define('7_4', function (User $user) {
            return $user->group->{'7_4'} === true;
        });

        Gate::define('8_1', function (User $user) {
            return $user->group->{'8_1'} === true;
        });
        Gate::define('8_2', function (User $user) {
            return $user->group->{'8_2'} === true;
        });
        Gate::define('8_3', function (User $user) {
            return $user->group->{'8_3'} === true;
        });
        Gate::define('8_4', function (User $user) {
            return $user->group->{'8_4'} === true;
        });

        Gate::define('9_1', function (User $user) {
            return $user->group->{'9_1'} === true;
        });
        Gate::define('9_2', function (User $user) {
            return $user->group->{'9_2'} === true;
        });
        Gate::define('9_3', function (User $user) {
            return $user->group->{'9_3'} === true;
        });
        Gate::define('9_4', function (User $user) {
            return $user->group->{'9_4'} === true;
        });

        Gate::define('10_1', function (User $user) {
            return $user->group->{'10_1'} === true;
        });
        Gate::define('10_2', function (User $user) {
            return $user->group->{'10_2'} === true;
        });
        Gate::define('10_3', function (User $user) {
            return $user->group->{'10_3'} === true;
        });
        Gate::define('10_4', function (User $user) {
            return $user->group->{'10_4'} === true;
        });

        Gate::define('11_1', function (User $user) {
            return $user->group->{'11_1'} === true;
        });
        Gate::define('11_2', function (User $user) {
            return $user->group->{'11_2'} === true;
        });
        Gate::define('11_3', function (User $user) {
            return $user->group->{'11_3'} === true;
        });
        Gate::define('11_4', function (User $user) {
            return $user->group->{'11_4'} === true;
        });
    }
}
