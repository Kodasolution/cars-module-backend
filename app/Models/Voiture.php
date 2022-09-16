<?php

namespace App\Models;

use App\Models\Equipement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voiture extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="voiture";

    /**
     * Get all of the Photos for the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Photos()
    {
        return $this->hasMany(Photos::class, 'voiture_id', 'id');
    }

    /**
     * The roles that belong to the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Equipements()
    {
        return $this->belongsToMany(Equipement::class, 'ligne_equipements_voiture', 'equipement_id', 'voiture_id');
    }
}
