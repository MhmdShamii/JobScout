<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', fn($user) => $user->isAdmin());
        Gate::define('isCompany', fn($user) => $user->isCompany());
        Gate::define('isUser', fn($user) => $user->isUser());
    }
}
