<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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
        Model::preventLazyLoading();
        Model::preventAccessingMissingAttributes();

        Gate::define('admin', function (User $user) {
            return $user->title === User::TITLE_ADMIN;
        });

        Gate::define('anggota', function (User $user) {
            return $user->title === User::TITLE_ANGGOTA;
        });
    }
}
