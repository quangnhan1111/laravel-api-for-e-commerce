<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'full_name'     => 'required|string|between:6,100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
//                password_confirmation
            'username'     => 'required|string|between:6,100',
            'address' => 'required|max:255',
            'phone_number' => 'required|min:11|numeric',
            'roles' => 'required',
        ];
    }

    public $validator = null;
    protected function failedValidation($validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], 422));
    }

    public function messages()
    {
        return [
            'email.required' => 'need can email',
            'password.required' => 'can pass',
            'password.min' => 'mat khau it nhat la 6 ki tu',
        ];
    }
}
