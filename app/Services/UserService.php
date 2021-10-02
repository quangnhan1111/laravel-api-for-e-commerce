<?php

namespace App\Services;
use App\Http\Requests\UserRequest;
use App\Http\Resources\AuthResource;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Utils\Helper;

class UserService
{


    public function getCustomers()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {

            $data = [];
            $customers = User::whereHas('roles', function($role) {
                $role->where('name', '=', 'customer');
            })->orderBy('id', 'desc')->get();
            for ($i = 0; $i<count($customers); $i++){
                array_push($data, new AuthResource($customers[$i]));
            }
            $helper = new Helper();
            $res = $helper->paginate($data);
            return $res;
        }
        return 'Unauthorized';
    }

    public function getCustomersAll()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {

            $data = [];
            $customers = User::whereHas('roles', function($role) {
                $role->where('name', '=', 'customer');
            })->orderBy('id', 'desc')->get();
            for ($i = 0; $i<count($customers); $i++){
                array_push($data, new AuthResource($customers[$i]));
            }
            return $data;
        }
        return 'Unauthorized';
    }

    public function getEmployees()
    {
        $user=Auth::user();
//        return $user->isAdmin();
        if($user->isAdmin() ) {

            $data = [];
            $customers = User::whereHas('roles', function($role) {
                $role->where('name', '=', 'employee');
            })->orderBy('id', 'desc')->get();
            for ($i = 0; $i<count($customers); $i++){
                array_push($data, new AuthResource($customers[$i]));
            }
            $helper = new Helper();
            $res = $helper->paginate($data);
            return $res;
        }
        return 'Unauthorized';
    }

    public function saveUser( $userUpdate, $inputs ): AuthResource
    {
        $userUpdate->full_name = $inputs['full_name'];
        $userUpdate->email = $inputs['email'];
        $userUpdate->address = $inputs['address'];
        $userUpdate->phone_number = $inputs['phone_number'];
        $userUpdate->username = $inputs['username'];
        if($inputs['password'] !== "") {
            $userUpdate->password = bcrypt($inputs['password']);
        }
        $userUpdate->save();
        $userUpdate->roles()->detach();
        $listOfRoles = explode(',', $inputs['roles']);//create array from separated/coma permissions
        foreach ($listOfRoles as $role) {
            $objRole=Role::where('name', $role)->first();
            $userUpdate->roles()->attach($objRole->id);
            $userUpdate->save();
        }
        return  new AuthResource($userUpdate);
    }

    public function store(UserRequest $request)
    {
        $inputs = $request->all();
        $user=Auth::user();
        $userUpdate = new User();
        $listOfRoles = explode(',', $request->roles);//create array from separated/coma permissions
        if($user->isAdmin()) {
            foreach ($listOfRoles as $role) {
                if($role=='admin') return response()->json('ko the save role admin');
            }
            return $this->saveUser($userUpdate, $inputs);
        }elseif ($user->isEmployee() ) {
            foreach ($listOfRoles as $role) {
                if($role=='admin' || $role=='employee') return ('ko the save admin hoac employee');
            }
            return $this->saveUser($userUpdate, $inputs);
        }
        return 'Unauthorized';
    }

    public function show(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin()) {
            return new AuthResource(User::query()->find($id));
        }elseif ($user->isEmployee()) {
            $userTarget = User::query()->find($id);
            if($userTarget->isAdmin()){
                return 'User cant find User with role is Admin';
            }
            return  new AuthResource($userTarget);
        }
        $userTarget = User::query()->find($id);
        if($userTarget->isAdmin() || $userTarget->isEmployee()){
            return 'User cant find User with role is Admin OR Emplyee';
        }
        return  new AuthResource($userTarget);
    }

    public function update(Request $request,int $id)
    {
        $user=Auth::user();
        $userUpdate=User::query()->find($id);
        if($user->getAuthIdentifier() == $id) return $this->saveUser($userUpdate,$request);
        if($user->isAdmin()) {
            if($userUpdate->isAdmin()) return response()->json('dang update admin khac');
            $listOfRoles = explode(',', $request->roles);//create array from separated/coma role
            foreach ($listOfRoles as $role) {
                if($role=='admin') return response()->json('ko the update role admin');
            }
            return $this->saveUser($userUpdate,$request);
        }elseif ($user->isEmployee()) {
            $listOfRoles = explode(',', $request->roles);//create array from separated/coma permissions
            foreach ($listOfRoles as $role) {
                if($role=='admin' || $role=='employee') return 'ko the update admin hoax org';
            }
            return $this->saveUser($userUpdate,$request);;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin()) {
            $userDestroy=User::query()->findOrFail($id);
            if($userDestroy->roles->contains('name','admin')) return 'ko the delete admin';
            $userDestroy->roles()->detach();
            $userDestroy->delete();
            return new AuthResource($userDestroy);

        }elseif ($user->isEmployee()) {
            $userDestroy=User::query()->findOrFail($id);
            if($userDestroy->isEmployee() || $userDestroy->isAdmin()) return 'ko the delete admin hay employee';
            $userDestroy->roles()->detach();
            $userDestroy->delete();
            return new AuthResource($userDestroy);

        }
        return 'Unauthorized';
    }

}
