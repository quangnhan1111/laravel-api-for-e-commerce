<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title'     => 'required|string|between:6,100',
            'content'    => 'required|string|between:10,5000',
//            'image_id'     => 'required'
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
            'title.required' => 'need can email',
            'title.string' => 'nam la String',
            'title.between' => 'chi tu 2 den 100',
            'content.required' => 'content needed',
//            'image_id.required' => 'image_id needed'
        ];
    }
}
