<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->role == User::ROLE_ADMIN;
        });

        Gate::define('shipper', function ($user) {
            if ($user->role == User::ROLE_SHIPPER) {
                return true;
            }
            return false;
        });

        Gate::define('stocker', function ($user) {
            return $user->role == User::ROLE_STOCKER;
        });
    }
}
