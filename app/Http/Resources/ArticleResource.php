<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            "nom_article"=>$this->nom_article,
            "prix_article"=>$this->prix_article,
            "type_article"=>$this->type_article,
            "slug_nom_article"=>$this->slug_nom_article,
            "actif"=>$this->actif,
            "nombre_view"=>$this->nombre_view,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
            "entreprise"=> new EntrepriseResource($this->entreprise),
            "photo"=>PhotoResource::collection($this->photos)
        ];
    }
}
