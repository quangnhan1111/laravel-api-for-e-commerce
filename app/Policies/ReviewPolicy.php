<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function view(User $user, Review $review)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function update(User $user, Review $review)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

    public function delete(User $user, Review $review)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function restore(User $user, Review $review)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

}
