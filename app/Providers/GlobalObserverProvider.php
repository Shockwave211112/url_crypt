<?php

namespace App\Providers;

use App\Observers\CacheObserver;
use Illuminate\Support\ServiceProvider;

use App\Modules\Auth\Models\ConfirmLinks;
use App\Modules\Auth\Models\RestoreLinks;
use App\Modules\Links\Models\Link;
use App\Modules\Links\Models\LinksGroups;
use App\Modules\Users\Models\User;


class GlobalObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $models = [
            User::class,
            Link::class,
            LinksGroups::class,
            ConfirmLinks::class,
            RestoreLinks::class,
        ];

        foreach ($models as $model) {
            $model::observe(CacheObserver::class);
        }
    }
}
