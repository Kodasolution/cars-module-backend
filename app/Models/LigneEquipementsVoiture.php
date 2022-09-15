<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneEquipementsVoiture extends Model
{
    use HasFactory;
    protected $fillable = ['equipement_id','entreprise_id'];
}
