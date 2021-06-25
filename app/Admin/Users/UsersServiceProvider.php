<?php

namespace App\Admin\Users;

use App\Admin\SidebarStore;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    public function boot(SidebarStore $sidebarStore): void
    {
        $sidebarStore->set('Users', 'admin.users.index', 'admin.users.*');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->loadViewsFrom(__DIR__ . '/Views', 'Admin\Users');
    }
}
