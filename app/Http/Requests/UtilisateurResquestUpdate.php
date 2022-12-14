<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UtilisateurResquestUpdate extends FormRequest
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
            'nom'=>"required|max:255",
            "prenom"=>"required",
            'email'=>'required', Rule::unique('users')->ignore($this->email),
            "phone"=>"required",
            'password'=>"required",
            'role'=>'required',
            'entreprise'=>''

        ];
    }
}
