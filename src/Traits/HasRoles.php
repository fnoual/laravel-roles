<?php

namespace Fnoual\Roles\Traits;

use Fnoual\Roles\Models\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user','user_id','role_id');
    }
}
