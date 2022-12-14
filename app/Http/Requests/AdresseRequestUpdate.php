<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdresseRequestUpdate extends FormRequest
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
            "pays"=>"required|max:255",
            "province"=>"required|max:255",
            "commune"=>"required|max:255",
            "zone"=>"required|max:255",
            "quartier"=>"required|max:255"
        ];
    }
}
