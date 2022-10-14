<?php

namespace App\Models;

use App\Models\Modele;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marque extends Model
{
    use HasFactory;
    protected $table="marque";
    protected $fillable = ['marque','logo_marque'];

    /**
     * Get all of the modeles for the Marque
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modeles()
    {
        return $this->hasMany(Modele::class, 'marque_id');
    }
}
