<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LigneLocationVoitureResquestStore extends FormRequest
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
            "date_debut"=>"required|date|date_format:Y-m-d|before_or_equal:today",
            "nombre_jrs"=>"required",
            "date_fin"=>"required|date|date_format:Y-m-d|after_or_equal:date_debut",
            "voiture_id"=>"required",
            "location_id"=>"required"
        ];
    }
}
