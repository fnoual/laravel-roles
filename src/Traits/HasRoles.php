<?php

namespace Fnoual\Roles\Traits;

use Fnoual\Roles\Models\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * @param string|array $roles
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'Cette action n\'est pas autorisée.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'Cette action n\'est pas autorisée.');
    }

    /**
     * Vérifier plusieurs rôles
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Vérifier un rôle
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function isAdmin()
    {
        return $this->roles->first()->id === config('roles.super_user_role_id');
    }

    public static function boot()
    {
        self::created(function ($model) {
            $model->roles()->attach(Role::find(config('roles.user_role_id')));
        });
    }
}
