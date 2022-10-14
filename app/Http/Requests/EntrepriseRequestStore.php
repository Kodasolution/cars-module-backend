<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrepriseRequestStore extends FormRequest
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
            "nom_entreprise"=>"required|unique:entreprises|max:255",
            "email_entreprise"=>"required|email",
            "telephone_entreprise"=>"required",
            "logo_entreprise"=>"",
            "quartier_id"=>"required",
            "nif_entreprise"=>"required",
            "type_entreprise"=>"required",
            "actif"=>"boolean",
            "rue"=>""

        ];
    }
}
