<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FactureDetailleResquestUpdate extends FormRequest
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
            'numero_facture_dt'=>'require',
            'date_facture_dt'=>'require',
            'montant_facture_dt'=>'require',
            'location_entreprise_id'=>'require'
        ];
    }
}
