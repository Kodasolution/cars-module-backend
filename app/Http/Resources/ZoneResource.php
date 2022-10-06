<?php

namespace App\Http\Resources;

use App\Http\Resources\QuartierResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ZoneResource extends JsonResource
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
            "nom_zone"=>$this->nom_zone,
            "commune_id"=>$this->commune_id,
            "quartier"=>QuartierResource::collection($this->quartiers)
        ];
    }
}
