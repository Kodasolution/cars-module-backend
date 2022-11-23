<?php

namespace App\Http\Resources;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ComoditeResource;
use App\Http\Resources\TypeSalleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResourceSalle extends JsonResource
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
            "id"=>$this->id,
            "numero_salle"=>$this->numero_salle,
            "type_salle_id" => $this->type_salle_id,
            "surface_salle" => $this->surface_salle,
            "capacite_accueil" => $this->capacite_accueil,
            "description_salle" => $this->description_salle,
            "libre" => $this->libre,
            "valide" => $this->valide,
            "type_salle"=> new TypeSalleResource($this->typeSalle),
            "comodite"=> ComoditeResource::collection($this->comodites)
        ];
    }
}
