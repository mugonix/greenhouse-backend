<?php

namespace App\Providers;

use App\Models\Role;
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

        Gate::define("manage-users", function ($user) {
            return $user->role_id == Role::where("role", "admin")->first(["id"])->id;
        });

        Gate::define('control-greenhouse', function ($user, $greenhouse) {
            return $user->id === $greenhouse->owner_id;
        });
    }
}
