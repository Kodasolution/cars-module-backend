<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'nom_utilisateur','prenom_utilisateur','telephone_utilisateur','email_utilisateur','password','role'
    ];
}
