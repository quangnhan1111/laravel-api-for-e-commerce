<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdatedRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name'     => 'required|string|between:2,100',
            'email'    => 'required|email',
            'username'     => 'required|string|between:2,100',
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

        ];
    }
}
