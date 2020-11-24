<?php

namespace Fnoual\Roles\Console;

use Illuminate\Console\Command;

class InstallRolesPackage extends Command
{
    protected $signature = 'roles:install';

    protected $description = 'Installe le gestionnaire de roles';

    public function handle()
    {
        $this->info('Installation ...');


        $this->call('vendor:publish', [
            '--provider' => "Fnoual\Roles\UseRoleServiceProvider",
            '--tag' => "migrations"
        ]);

        $this->call('migrate');

        $this->info('Package installé.');
    }
}
