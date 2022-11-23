<?php

namespace App\Models;

use App\Models\Chambres;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comodite extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
     * The chambres that belong to the Comodite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function chambres()
    {
        return $this->belongsToMany(Chambres::class, 'ligne_comodites_chambre', 'comodite_id', 'chambre_id');
    }


    public function salles()
    {
        return $this->belongsToMany(Chambres::class, 'ligne_comodites_salle', 'comodite_id', 'salle_id');
    }

}
