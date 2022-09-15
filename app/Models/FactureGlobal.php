<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureGlobal extends Model
{
    use HasFactory;
    protected $fillable = ['numero_facture_gl','date_facture_gl','montant_facture_gl','location_id'];
}
