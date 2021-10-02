<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct()
    {
        $this->authService=new AuthService();
    }//end __construct()


    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);

    }//end login()

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json(['message' => 'User logged out successfully']);

    }//end logout()

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'full_name'     => 'required|string|between:2,100',
                'email'    => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
//                password_confirmation
                'username'     => 'required|string|between:2,100',
                'address' => 'required|max:255',
                'phone_number' => 'required|min:11|numeric',
                'roles' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                ['error'  => 'Unprocessable Entity'],
                422
            );
        }

        $inputs = $request->all();
        $userUpdate = new User();
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
        return response()->json(['message' => 'User created successfully', 'info' => new AuthResource($userUpdate)]);

    }//end register()


}//end class
