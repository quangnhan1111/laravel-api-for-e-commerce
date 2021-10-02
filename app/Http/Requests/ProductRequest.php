<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => 'required|string|between:2,100',
            'price'    => 'required|numeric',
            'name_size'     => 'required',
            'number'     => 'required|numeric',
            'des'     => 'required|string|between:2,500',
            'brand_id'     => 'required|numeric',
            'gender_id'     => 'required|numeric',
            'image_id'     => 'required|numeric',
            'cate_id'     => 'required|numeric',
            'color_id'     => 'required|numeric',
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
            'name_size.required' => 'content needed',
        ];
    }
}
