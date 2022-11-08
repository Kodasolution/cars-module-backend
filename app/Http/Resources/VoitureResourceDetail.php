<?php

namespace App\Http\Resources;

use App\Http\Resources\PhotoResource;
use App\Http\Resources\MarqueResource;
use App\Http\Resources\ModeleResource;
use App\Http\Resources\AdresseResource;
use App\Http\Resources\EntrepriseResource;
use App\Http\Resources\TypeVoitureResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VoitureResourceDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
        [           
            "article"=> new ArticleResource($this->article),
            "type_voiture"=>new TypeVoitureResource($this->type),
            "modele"=>new ModeleResource($this->modele),
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
            "kilometrage"=>$this->kilometrage,
            "nom_voiture"=>$this->nom_voiture,
            "nombre_places"=>$this->nombre_places,
            "nombre_portes"=>$this->nombre_portes,
            "numero_de_chassis"=>$this->numero_de_chassis,
            "plaque"=>$this->plaque,
            "poids"=>$this->poids,
            "prix"=>$this->prix,
            "slug_nom_vehicule"=>$this->slug_nom_vehicule,
            "updated_at"=>$this->updated_at,
            "valide"=>$this->valide,
            "volant"=>$this->volant,
            "version"=>$this->version,
      
            // "marque_id"=>new MarqueResource($this->marque),
            "equipement"=> EquipementResource::collection($this->equipements)
        ];
    }
}
