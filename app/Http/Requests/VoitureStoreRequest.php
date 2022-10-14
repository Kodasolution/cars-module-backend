<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoitureStoreRequest extends FormRequest
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
            "nom_voiture" => "required",
            "plaque" => "required|unique:voiture,plaque",
            "boite_de_vitesse" => "required",
            "kilometrage" => "required",
            "numero_de_chassis" => "required",
            "couleur" => "required",
            "carburant" => "required",
            "volant" => "required",
            "nombre_places" => "required",
            "nombre_portes" => "required",
            "annee_de_fabrication" => "required",
            "prix" => "required",
            "type_voiture_id" => "required",
            "model_id" => "required",
            "entreprise_id" => "required",
            "marque_id"=>"required",
            "valide" => 'boolean',
            "en_location" => 'boolean',
            "active" => 'boolean',
            "condition_de_location" => "",
            "slug_nom_vehicule" => "",
            "consommation" => "",
            "capacite_charge_max" => "",
            
        ];
    }
}
