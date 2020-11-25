<?php

namespace Fnoual\Roles\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallRolesPackage extends Command
{
    protected $signature = 'roles:install';

    protected $description = 'Installe le gestionnaire de roles';

    public function handle()
    {
        $this->info('Installation ...');

        $this->call('vendor:publish', [
            '--provider' => "Fnoual\Roles\UseRoleServiceProvider"
        ]);

        $this->call('migrate:fresh');

        $this->info('Table créée avec succès.');

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
            'description' => 'Administrateur Système',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'user',
            'description' => 'Utilisateur',
        ]);

        $this->info('Rôles admin et utilisateurs créés 👍');

        $this->info('Package installé 🚀');
    }
}
