<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FactureGlobalResquestStore extends FormRequest
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
            'numero_facture_gl'=>'require',
            'date_facture_gl'=>'require',
            'montant_facture_gl'=>'require',
            'location_id'=>'require'
        ];
    }
}
