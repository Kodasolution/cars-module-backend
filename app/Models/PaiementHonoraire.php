<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementHonoraire extends Model
{
    use HasFactory;
    protected $fillable = ['date_paiement','montant','reference','honoraire_id','utilisateur_id'];
}
