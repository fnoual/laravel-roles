<?php

namespace Fnoual\Roles;

use Fnoual\Roles\Console\InstallRolesPackage;
use Illuminate\Support\ServiceProvider;

class UseRoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/roles.php', 'roles');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallRolesPackage::class,
            ]);
            if (! class_exists('CreateRolesTable')) {
                $this->publishes([
                    __DIR__ . '/database/migrations/create_roles_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_roles_table.php'),
                ], 'migrations');
            }
            if (! class_exists('CreateRolesTable')) {
                $this->publishes([
                    __DIR__ . '/database/migrations/create_role_user_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_role_user_table.php'),
                ], 'migrations');
            }
            if (! class_exists('RolesTableSeeder')) {
                $this->publishes([
                    __DIR__ . '/database/seeders/RolesTableSeeder.php.stub' => database_path('seeds/RolesTableSeeder.php'),
                ], 'seeds');
            }
            $this->publishes([
                __DIR__.'/config/roles.php' => config_path('roles.php'),
            ], 'config');
        }

    }
}
