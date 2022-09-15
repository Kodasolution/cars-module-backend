<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impot extends Model
{
    use HasFactory;
    protected $fillable = ['montant_impot','taux_impot','paye','location_entreprise_id'];
}
