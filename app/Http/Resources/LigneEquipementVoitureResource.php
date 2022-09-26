<?php

namespace App\Http\Resources;

use App\Http\Resources\VoitureResource;
use App\Http\Resources\EquipementResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LigneEquipementVoitureResource extends JsonResource
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
            "equipement_id"=>$this->equipement_id,
            "voiture_id"=>$this->voiture_id,
            // "equipement"=>EquipementResource::collection($this->equipements),
            // "voiture"=>VoitureResource::collection($this->voitures),
        ];
    }
}
