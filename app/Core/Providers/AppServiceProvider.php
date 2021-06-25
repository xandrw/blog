<?php

namespace App\Core\Providers;

use App\Admin\AdminServiceProvider;
use App\Auth\Providers\AuthServiceProvider;
use App\Users\Providers\UsersServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadViewsFrom(__DIR__ . '/../Views', 'Core');
        Blade::componentNamespace('App\\Core\\Components', 'core');

        Paginator::defaultView('Core::pagination.default');
        Paginator::defaultSimpleView('Core::pagination.simple-default');

        $this->app->register(AuthServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        // $this->app->register(BroadcastServiceProvider::class);

        $this->app->register(UsersServiceProvider::class);
        $this->app->register(AdminServiceProvider::class);
    }
}
