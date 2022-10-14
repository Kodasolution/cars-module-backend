<?php

namespace App\Http\Resources;

use App\Http\Resources\AdresseResource;
use App\Http\Resources\QuartierResource;
use App\Http\Resources\AgenceVoitureResource;
use App\Http\Resources\VoitureResourceDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class VoitureByAgenceResource extends JsonResource
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
            "id" => $this->id,
            "nom_entreprise" => $this->nom_entreprise,
            "email_entreprise" => $this->email_entreprise,
            "telephone_entreprise" => $this->telephone_entreprise,
            "logo_entreprise" => $this->logo_entreprise,
            "nif_entreprise" => $this->nif_entreprise,
            "type_entreprise" => $this->type_entreprise,
            "actif" => $this->actif,
            "adresse" => new QuartierResource($this->quartier),
            "voiture" => AgenceVoitureResource::collection($this->voitures),
        ];
    }
}
