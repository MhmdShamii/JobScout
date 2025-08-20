<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Job;

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

        Gate::define('comp-act', function (User $user, ?Job $job = null) {
            if (!$job) return false;
            return $user->isAdmin() || ((int)$job->employer?->id === (int)$user->employer?->id);
        });
    }
}
