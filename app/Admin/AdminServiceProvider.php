<?php

namespace App\Admin;

use App\Admin\Users\AdminUsersServiceProvider;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SidebarStore::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'Admin');

        $this->app->register(AdminUsersServiceProvider::class);
    }
}
