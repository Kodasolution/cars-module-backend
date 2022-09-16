<?php

namespace App\Models;

use App\Models\Entreprise;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utilisateur extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'nom_utilisateur','prenom_utilisateur','telephone_utilisateur','email_utilisateur','password','role'
    ];

    /**
     * Get the Entreprise that owns the Utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
