<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'username' => 'required|max:255',
            'password' => 'required|string|min:6',
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
