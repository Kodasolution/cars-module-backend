<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommuneRequestStore extends FormRequest
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
            "nom_commune"=>"required|unique:communes|max:255",
            "province_id"=>"required"

        ];
    }
}
