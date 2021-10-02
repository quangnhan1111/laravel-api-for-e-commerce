<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
//    public function before($user): bool
//    {
//        if ($user->isAdmin())
//            return true;
//        return false;
//    }

    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function view(User $user, User $model)
    {
        if ($user->isAdmin() || $user->isEmployee() ||  $user->isCustomer()) return true;
        return false;
    }


    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee() || $user->isCustomer()) return true;
        return false;
    }



    public function update(User $user, User $model)
    {
        if ($user->isAdmin() || $user->isEmployee() ||$user->isCustomer()) return true;
        return false;
    }


    public function delete(User $user, User $model)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


}
