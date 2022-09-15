<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonoraireAgence extends Model
{
    use HasFactory;
    protected $fillable = ['montant_honoraire','paye','location_entreprise_id'];
}
