<?php

namespace App\Models;

use App\Models\Commune;
use App\Models\Quartier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zone extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * Get the commune that owns the Zone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    /**
     * Get all of the quartiers for the Zone
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quartiers()
    {
        return $this->hasMany(Quartier::class, 'zone_id');
    }

}
