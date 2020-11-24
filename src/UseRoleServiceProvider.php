<?php

namespace Fnoual\Roles;

use Fnoual\Roles\Console\InstallRolesPackage;
use Illuminate\Support\ServiceProvider;

class UseRoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallRolesPackage::class,
            ]);
        }
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateRolesTable')) {
                $this->publishes([
                    __DIR__ . '/database/migrations/create_roles_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_roles_table.php'),
                ], 'migrations');
            }
        }
    }
}
