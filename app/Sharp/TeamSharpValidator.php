<?php

namespace App\Sharp;

use Illuminate\Foundation\Http\FormRequest;

class TeamSharpValidator extends FormRequest
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
            "name" => "required",
            "country" => "required",
            "titles.*.competition" => "required"
        ];
    }
}