<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function view(User $user, Image $image)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function update(User $user, Image $image)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function delete(User $user, Image $image)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function restore(User $user, Image $image)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

}
