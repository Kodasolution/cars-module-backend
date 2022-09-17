<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationEntrepriseResquestUpdate extends FormRequest
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
            "date_location"=>"required|date|date_format:Y-m-d|before_or_equal:today",
            "montant_total"=>"required|max:255",
            "entreprise_id"=>"required",
            "location_id"=>"required"
        ];
    }
}
