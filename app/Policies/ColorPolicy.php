<?php

namespace App\Policies;

use App\Models\Color;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ColorPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function view(User $user, Color $color)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function update(User $user, Color $color)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function delete(User $user, Color $color)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function restore(User $user, Color $color)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function forceDelete(User $user, Color $color)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }
}
