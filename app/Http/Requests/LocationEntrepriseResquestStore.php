<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationEntrepriseResquestStore extends FormRequest
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
            "date_location"=>"required|max:255",
            "montant_total"=>"required|max:255",
            "entreprise_id"=>"required",
            "location_id"=>"required"
        ];
    }
}
