<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        //


        Gate::before(function ($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        Gate::define('view-dashboard', function (User $user) {
            return $user->isModo();
        });

        Gate::define('scan', function (User $user) {
            return $user->isModo();
        });

        Gate::define('handle-invitations', function (User $user) {
            return $user->isModo();
        });

        Gate::define('exec-commands', function (User $user) {
            return $user->isAdmin();
        });
    }
}
