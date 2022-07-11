<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatepatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "date" => "required",
            "name" => "required",
            "age" => "required|numeric",
            "in" => "required|in:Y,M",
            "gender" => "required|in:M,F,O",
            "address" => "required",
            "phone" => "nullable",
            "email" => "nullable",
            "referred" => "nullable",
            "remarks" => "nullable"
        ];
    }
}
