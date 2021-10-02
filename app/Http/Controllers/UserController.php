<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdatedRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }//end __construct()

    public function getCustomersAll()
    {
        $user=Auth::user();
//        return $user->isEmployee();
        if($this->authorize('viewAny', $user)) {
            $users = $this->userService->getCustomersAll();
            return $this->response("successfully", $users, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getCustomers()
    {
        $user=Auth::user();
//        return $user->isEmployee();
        if($this->authorize('viewAny', $user)) {
            $users = $this->userService->getCustomers();
            return $this->response("successfully", $users, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function getEmployees()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $users = $this->userService->getEmployees();
            return $this->response("successfully", $users, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }



    public function store(UserRequest $request)
    {
        $user=Auth::user();
        if($this->authorize('create', $user)) {
            $user = $this->userService->store($request);
            return $this->response("successfully", $user, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function show(int $id)
    {
        $user=Auth::user();
        if($this->authorize('view',$user)) {
            $user = $this->userService->show($id);
            return $this->response("successfully", $user, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function update(UserUpdatedRequest $request, int $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $user = $this->userService->update($request, $id);
            return $this->response("successfully", $user, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function destroy(int $id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $user = $this->userService->destroy($id);
            return $this->response("successfully", $user, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
