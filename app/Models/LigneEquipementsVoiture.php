<?php

namespace App\Models;

use App\Models\Voiture;
use App\Models\Equipement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LigneEquipementsVoiture extends Model
{
    use HasFactory;
    protected $table="ligne_equipements_voiture";
    protected $fillable = ['equipement_id','voiture_id'];

    /**
     * Get all of the voitures for the LigneEquipementsVoiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function voitures()
    {
        return $this->belongsToMany(Voiture::class, 'ligne_equipements_voiture',"voiture_id", 'id' );
    }

    /**
     * Get all of the equipemets for the LigneEquipementsVoiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipemets()
    {
        return $this->belongsToMany(Equipement::class, 'ligne_equipements_voiture', 'equipement_id',"id");
    }
}
