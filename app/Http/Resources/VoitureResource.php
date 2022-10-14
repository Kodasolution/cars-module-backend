<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoitureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "active"=>$this->active,
            "annee_de_fabrication"=>$this->annee_de_fabrication,
            "boite_de_vitesse"=>$this->boite_de_vitesse,
            "capacite_charge_max"=>$this->capacite_charge_max,
            "carburant"=>$this->carburant,
            "condition_de_location"=>$this->condition_de_location,
            "consommation"=>$this->consommation,
            "couleur"=>$this->couleur,
            "created_at"=>$this->created_at,
            "en_location"=>$this->en_location,
            "entreprise_id"=>$this->entreprise_id,
            "kilometrage"=>$this->kilometrage,
            "model_id"=>$this->model_id,
            "marque_id"=>$this->marque_id,
            "nom_voiture"=>$this->nom_voiture,
            "nombre_places"=>$this->nombre_places,
            "nombre_portes"=>$this->nombre_portes,
            "numero_de_chassis"=>$this->numero_de_chassis,
            "plaque"=>$this->plaque,
            "poids"=>$this->poids,
            "prix"=>$this->prix,
            "slug_nom_vehicule"=>$this->slug_nom_vehicule,
            "type_voiture_id"=>$this->type_voiture_id,
            "updated_at"=>$this->updated_at,
            "valide"=>$this->valide,
            "volant"=>$this->volant,
            "version"=>$this->version,
        ];
    }
}
