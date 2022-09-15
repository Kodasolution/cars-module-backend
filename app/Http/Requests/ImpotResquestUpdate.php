<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImpotResquestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'montant_impot' => 'required',
            'taux_impot' => 'required',
            'paye' => 'required',
            'location_entreprise_id' => 'required',
        ];
    }
}
