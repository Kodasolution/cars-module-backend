<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data=[
            "id"=>$this->id,
            // "user_id"=>$this->user_id,
            "principale"=>$this->principale,
            "entreprise_id"=>$this->entreprise_id,
            "user"=>new UserResource($this->user),
        ];
        return $data;
    }
}
