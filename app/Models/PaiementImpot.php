<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementImpot extends Model
{
    use HasFactory;
    protected $fillable = ['date_paiement','montant','reference','impot_id','utilisateur_id'];
}
