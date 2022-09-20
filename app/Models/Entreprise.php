<?php

namespace App\Models;

use App\Models\Admin;
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
}
