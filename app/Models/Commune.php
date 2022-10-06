<?php

namespace App\Models;

use App\Models\Zone;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commune extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
     * Get the Province that owns the Commune
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Province()
    {
        return $this->belongsTo(Province::class);
    }
    /**
     * Get all of the zones for the Commune
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zones()
    {
        return $this->hasMany(Zone::class, 'commune_id');
    }
}
