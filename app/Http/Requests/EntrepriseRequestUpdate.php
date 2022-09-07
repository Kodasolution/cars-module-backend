<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EntrepriseRequestUpdate extends FormRequest
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
            "nom_entreprise"=>'required', Rule::unique('entreprises')->ignore($this->nom_entreprise),
            "email_entreprise"=>"required|email",
            "telephone_entreprise"=>"required",
            "logo_entreprise"=>"",
            "adresse_entreprise"=>"required",
            "nif_entreprise"=>"required",
            "type_entreprise"=>"required",
            "actif"=>"",
            "latitude"=>""
        ];
    }
}
