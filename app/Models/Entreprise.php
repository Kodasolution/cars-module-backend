<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Voiture;
use App\Models\Quartier;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entreprise extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * Get all of the Utilisateurs for the Entreprise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'entreprise_id');
    }

    /**
     * Get all of the admins for the Entreprise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admins()
    {
        return $this->hasMany(Admin::class, 'entreprise_id');
    }

    /**
     * Get the adresse that owns the Entreprise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quartier()
    {
        return $this->belongsTo(Quartier::class);
    }
    /**
     * Get all of the voitures for the Entreprise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'entreprise_id');
    }
}
