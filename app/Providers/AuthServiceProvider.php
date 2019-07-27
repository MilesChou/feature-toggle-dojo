<?php

namespace App\Providers;

use MilesChou\Toggle\Toggle;
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
    public function boot(Toggle $toggle)
    {
        $this->registerPolicies();

        Gate::define('is_show_home_on_home', function ($user = null) use ($toggle) {
            return $toggle->isActive('is_show_home_on_home');
        });

        Gate::define('is_show_home_on_product', function ($user = null) use ($toggle) {
            return $toggle->isActive('is_show_home_on_product');
        });
    }
}
