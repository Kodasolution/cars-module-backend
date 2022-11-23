<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Comodite;
use App\Models\TypeSalle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salle extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the user that owns the Salle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    /**
     * Get the user that owns the Salle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeSalle()
    {

        return $this->belongsTo(TypeSalle::class);
    }
    /**
     * The comodites that belong to the Chambres
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comodites()
    {
        return $this->belongsToMany(Comodite::class, 'ligne_comodites_salle', 'salle_id', 'comodite_id');
    }
}
