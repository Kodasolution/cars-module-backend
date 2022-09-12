<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequestStore extends FormRequest
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
            "nom_client"=>"required|max:255",
            "prenom_client"=>"required|max:255",
            "telephone_client"=>"required|max:255",
            "password"=>"required|max:255",
            "actif"=>"required",
            "email_client"=>"required|unique:clients|max:255"
        ];
    }
}
