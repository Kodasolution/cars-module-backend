<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationEntreprise extends Model
{
    use HasFactory;
    protected $fillable = ['date_location','montant_total','entreprise_id','location_id'];
}
