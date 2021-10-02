<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee() || $user->isCustomer()) return true;
        return false;
    }


    public function view(User $user, Invoice $invoice)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isEmployee() || $user->isCustomer()) return true;
        return false;
    }

    public function update(User $user, Invoice $invoice)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function delete(User $user, Invoice $invoice)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }


    public function restore(User $user, Invoice $invoice)
    {
        if ($user->isAdmin() || $user->isEmployee()) return true;
        return false;
    }

}
