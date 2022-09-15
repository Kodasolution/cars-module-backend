<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneLocationVoiture extends Model
{
    use HasFactory;
    protected $fillable = ['date_debut','nombre_jrs','date_fin','voiture_id','location_id'];
}
