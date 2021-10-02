<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function view(User $user, Brand $brand)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function update(User $user, Brand $brand)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function delete(User $user, Brand $brand)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function restore(User $user, Brand $brand)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


}
