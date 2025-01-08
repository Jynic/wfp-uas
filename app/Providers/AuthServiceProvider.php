<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\User_model;
use App\Policies\RoutePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => RoutePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('accessAdminPages', function (User_model $user) {
            return $user->idjabatan == 1;
        });

        Gate::define('accessUserPages', function (User_model $user) {
            return $user->idjabatan == 2;
        });

        Gate::define('accessStaffPages', function (User_model $user) {
            return $user->idjabatan == 1 || $user->idjabatan == 3 || $user->idjabatan == 4;
        });

        Gate::define('accessManajerPages', function (User_model $user) {
            return $user->idjabatan == 1 || $user->idjabatan == 4;
        });
    }
}
