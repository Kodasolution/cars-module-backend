<?php

namespace App\Http\Resources;

use App\Http\Resources\ProvinceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommuneResource extends JsonResource
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
            "nom_commune"=>$this->nom_commune,
            "province_id"=>$this->province_id,
            "zone"=> ZoneResource::collection($this->zones)
        ];
    }
}
