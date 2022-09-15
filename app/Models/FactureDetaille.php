<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureDetaille extends Model
{
    use HasFactory;
    protected $fillable = ['numero_facture_dt','montant_facture_dt','facture_gl_id','location_entreprise_id'];
}
