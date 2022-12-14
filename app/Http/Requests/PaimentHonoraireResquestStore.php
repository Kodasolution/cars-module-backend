<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaimentHonoraireResquestStore extends FormRequest
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
            "utilisateur_id"=>"required",
            "honoraire_id"=>"required",
            "reference"=>"required",
            "montant"=>"required",
            "date_paiement"=>"required"
        ];
    }
}
