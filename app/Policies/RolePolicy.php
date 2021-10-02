<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->isAdmin()) return true;
        return false;
    }

    public function view(User $user, Role $role)
    {
        if ($user->isAdmin()) return true;
        return false;
    }

    public function create(User $user)
    {
        if ($user->isAdmin()) return true;
        return false;
    }

    public function update(User $user, Role $role)
    {
        if ($user->isAdmin()) return true;
        return false;
    }

    public function delete(User $user, Role $role)
    {
        if ($user->isAdmin()) return true;
        return false;
    }

    public function restore(User $user, Role $role)
    {
        if ($user->isAdmin()) return true;
        return false;
    }

    public function forceDelete(User $user, Role $role)
    {
        if ($user->isAdmin()) return true;
        return false;
    }
}
