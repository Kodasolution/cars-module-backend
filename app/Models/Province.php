<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get all of the Communes for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Communes()
    {
        return $this->hasMany(Commune::class, 'province_id');
    }
}
