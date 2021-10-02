<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function view(User $user, Product $product)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function update(User $user, Product $product)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function delete(User $user, Product $product)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function restore(User $user, Product $product)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function forceDelete(User $user, Product $product)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }
}
