<?php

namespace App\Providers;

use App\Modules\Core\Observers\RelationObserver;
use App\Modules\Core\Observers\UsersObserver;
use App\Modules\Links\Models\Link;
use App\Modules\Users\Models\User;
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
        User::observe(UsersObserver::class);
    }
}
