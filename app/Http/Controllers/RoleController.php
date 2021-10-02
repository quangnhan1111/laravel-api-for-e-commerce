<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }//end __construct()

    public function getUserByRoles(int $id)
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $userByRoles = $this->roleService->getUserByRoles($id);
            return $this->response("successfully", $userByRoles, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function index()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $roles = $this->roleService->index();
            return $this->response("successfully", $roles, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function store(RoleRequest $request)
    {
        $user=Auth::user();
        if($this->authorize('create', $user)) {
            $role = $this->roleService->store($request);
            return $this->response("successfully", $role, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function show($id)
    {
        $user=Auth::user();
        if($this->authorize('view',$user)) {
            $role = $this->roleService->show($id);
            return $this->response("successfully", $role, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function update(RoleRequest $request, $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $role = $this->roleService->update($request, $id);
            return $this->response("successfully", $role, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $role = $this->roleService->destroy($id);
            return $this->response("successfully", $role, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
