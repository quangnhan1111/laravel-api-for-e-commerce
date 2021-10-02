<?php
namespace App\Repositories\Role;

use App\Http\Resources\AuthResource;
use App\Models\Role;
use App\Models\User;
use App\Repositories\BaseRepository;


class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

    protected $model;

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }


    public function getUserByRoles($id)
    {
        $roleName = Role::query()->find($id)->name;
        $userByRoles = User::whereHas('roles', function($role) use ($roleName) {
            $role->where('name', '=', $roleName);
        })->orderBy('id', 'desc')->paginate(10);

//        $userByRoles->each(function ($user) {
//            new AuthResource($user);
//        });

        return $userByRoles;
    }
}
