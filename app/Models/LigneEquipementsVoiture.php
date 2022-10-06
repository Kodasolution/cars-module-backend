<?php

namespace App\Models;

use App\Models\Voiture;
use App\Models\Equipement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LigneEquipementsVoiture extends Model
{
    use HasFactory;
    protected $table="ligne_equipements_voiture";
    protected $fillable = ['equipement_id','voiture_id'];

}
