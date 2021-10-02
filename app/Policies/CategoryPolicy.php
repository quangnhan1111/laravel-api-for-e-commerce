<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function view(User $user, Category $category)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function update(User $user, Category $category)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function delete(User $user, Category $category)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


}
