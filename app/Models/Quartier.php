<?php

namespace App\Models;

use App\Models\Zone;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quartier extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * Get the zone that owns the Quartier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * Get all of the entreprises for the Quartier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entreprises()
    {
        return $this->hasMany(Entreprise::class, 'quartier_id');
    }

}
