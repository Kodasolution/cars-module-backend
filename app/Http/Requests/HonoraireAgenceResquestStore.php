<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HonoraireAgenceResquestStore extends FormRequest
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
            'montant_honoraire'=>'required',
            'paye'=>'required',
            'location_entreprise_id'=>'required'
        ];
    }
}
