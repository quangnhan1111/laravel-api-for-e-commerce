<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'     => 'required|string|between:2,100',
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
            'name.required' => 'need can email',
            'name.string' => 'nam la String',
            'name.between' => 'chi tu 2 den 100',
        ];
    }
}
