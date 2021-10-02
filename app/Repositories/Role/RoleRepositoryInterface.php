<?php


namespace App\Repositories\Role;
use App\Repositories\BaseRepositoryInterface;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserByRoles($id);
}
