<?php

namespace App\Http\Resources;

use App\Http\Resources\MarqueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ModeleResource extends JsonResource
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
            'id'=>$this->id,
            'modele'=>$this->modele,
            "marque"=>new MarqueResource($this->marque)
        ];
    }
}
