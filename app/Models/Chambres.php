<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Comodite;
use App\Models\TypeChambres;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chambres extends Model
{
    use HasFactory;
    protected $guarded = [];

     /**
     * Get the entreprise that owns the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

        /**
     * Get the entreprise that owns the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeChambre()
    {
        return $this->belongsTo(TypeChambres::class);
    }

    /**
     * The comodites that belong to the Chambres
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comodites()
    {
        return $this->belongsToMany(Comodite::class, 'ligne_comodites_chambre', 'chambre_id', 'comodite_id');
    }
 
}
