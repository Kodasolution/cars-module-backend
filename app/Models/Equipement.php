<?php

namespace App\Models;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipement extends Model
{
    use HasFactory;
    protected $table="equipement";
    protected $guarded =[];

    /**
     * The roles that belong to the Equipement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function voitures()
    {
        return $this->belongsToMany(Voiture::class, 'ligne_equipements_voiture', 'voiture_id', 'equipement_id');
    }
}
