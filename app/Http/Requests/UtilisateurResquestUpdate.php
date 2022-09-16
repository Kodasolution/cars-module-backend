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
            "nom_utilisateur"=>"required",
            "prenom_utilisateur"=>"required",
            "telephone_utilisateur"=>"required",
            "email_utilisateur"=>'required', Rule::unique('utilisateurs')->ignore($this->email_utilisateur),
            "password"=>"required",
            "role"=>"required",
            "entreprise_id"=>"required",

        ];
    }
}
