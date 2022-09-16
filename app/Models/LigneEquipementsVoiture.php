<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneEquipementsVoiture extends Model
{
    use HasFactory;
    protected $table="ligne_equipements_voiture";
    protected $fillable = ['equipement_id','voiture_id'];
}
