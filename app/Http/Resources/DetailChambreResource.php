<?php

namespace App\Http\Resources;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ComoditeResource;
use App\Http\Resources\TypeChambreresource;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailChambreResource extends JsonResource
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
            "numero_chambre" => $this->numero_chambre,
            "type_chambre_id" => $this->type_chambre_id,
            "surface_chambre" => $this->surface_chambre,
            "nombre_lits" => $this->nombre_lits,
            "nombre_personnes" => $this->nombre_personnes,
            "description_chambre" => $this->description_chambre,
            "libre" => $this->libre,
            "valide" => $this->valide,
            "type_chambre"=> new TypeChambreresource($this->typeChambre),
            "comodite"=> ComoditeResource::collection($this->comodites)
        ];
    }
}
