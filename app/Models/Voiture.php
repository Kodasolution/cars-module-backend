<?php

namespace App\Models;

use App\Models\Marque;
use App\Models\Modele;
use App\Models\Photos;
use App\Models\Adresse;
use App\Models\Location;
use App\Models\Entreprise;
use App\Models\Equipement;
use App\Models\TypeVoiture;
use App\Models\LigneEquipementsVoiture;
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
    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'ligne_equipements_voiture', 'equipement_id', 'voiture_id');
    }

    /**
     * The Locations that belong to the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Locations()
    {
        return $this->belongsToMany(Location::class, 'ligne_location_voiture', 'location_id', 'voiture_id');
    }
    /**
     * Get the entreprise that owns the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    /**
     * Get the adresse that owns the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adresse()
    {
        return $this->belongsTo(Adresse::class);
    }
    /**
     * Get the type that owns the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(TypeVoiture::class,'type_voiture_id');
    }
    /**
     * Get the model that owns the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modele()
    {
        return $this->belongsTo(Modele::class,'model_id');
    }


      /**
     * Get the marque that owns the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marque()
    {
        return $this->belongsTo(Marque::class,'marque_id');
    }

    /**
     * Get all of the ligneVoitureEquipement for the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ligneVoitureEquipements()
    {
        return $this->hasMany(LigneEquipementsVoiture::class, 'voiture_id', 'id');
    }
}
