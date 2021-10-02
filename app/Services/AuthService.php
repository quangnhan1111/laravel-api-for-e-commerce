<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(LoginRequest $request)
    {
        $this->guard()->factory()->setTTL(24*60);


        if (!$token = $this->guard()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        $this->guard()->logout();
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());

    }//end refresh()


    protected function respondWithToken($token)
    {
        $user = Auth::user();
        $roles = [];
        for($i = 0 ; $i < count($user->roles) ; $i++) {
            array_push($roles, $user->roles[$i]->name);
        }
        return response()->json(
            [
                'token'          => $token,
                'token_type'     => 'bearer',
                'token_validity' => ($this->guard()->factory()->getTTL() * 60),
                'info'          =>  new AuthResource($user),
                'rolesName'         => $roles
            ]
        );

    }//end respondWithToken()


    protected function guard()
    {
        return Auth::guard();

    }//end guard()

}

