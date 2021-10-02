<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReviewRequest extends FormRequest
{

    public function rules()
    {
        return [
            'number_of_star'     => 'required|numeric',
            'content'    => 'required|string|between:2,500',
            'product_id'     => 'required',
            'user_id'     => 'required'
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
            'number_of_star.required' => 'need can email',
            'content.string' => 'nam la String',
            'content.required' => 'chi tu 2 den 100',
            'content.between' => 'content needed',
            'product_id.required' => 'image_id needed',
            'user_id.required' => 'image_id needed'
        ];
    }
}
