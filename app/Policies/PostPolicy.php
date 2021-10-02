<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function view(User $user, Post $post)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function update(User $user, Post $post)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function delete(User $user, Post $post)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function restore(User $user, Post $post)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

}
