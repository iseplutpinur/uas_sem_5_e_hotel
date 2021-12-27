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
    }
}
