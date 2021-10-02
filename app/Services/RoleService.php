<?php

namespace App\Services;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class RoleService
{
    private RoleRepositoryInterface $roleRepositoryInterface;
    public function __construct(RoleRepositoryInterface $roleRepositoryInterface)
    {
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }

    public function getUserByRoles($id)
    {
        $user=Auth::user();
        if($user->isAdmin() ) {
            $userByRoles = $this->roleRepositoryInterface->getUserByRoles($id);
            return $userByRoles;
        }
        return 'Unauthorized';
    }

    public function index()
    {
        $user=Auth::user();
        if($user->isAdmin()) {
            $roles = $this->roleRepositoryInterface->index();
            return $roles;
        }
        return 'Unauthorized';
    }

    public function store(RoleRequest $request)
    {
        $inputs = $request->all();
        $user=Auth::user();
        $role = new Role();
        if($user->isAdmin()) {
            $result = $this->roleRepositoryInterface->store($role, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }

    public function show(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin()) {
            $role = $this->roleRepositoryInterface->show($id);
            return $role;
        }
        return 'Unauthorized';
    }

    public function update(RoleRequest $request,int $id)
    {
        $inputs = $request->all();
        $user=Auth::user();
        if($user->isAdmin() ) {
            $roleUpdate=Role::query()->findOrFail($id);
            $result = $this->roleRepositoryInterface->update($roleUpdate, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin()) {
            $roleDestroy = $this->roleRepositoryInterface->destroy($id);
            return $roleDestroy;
        }
        return 'Unauthorized';
    }

}
