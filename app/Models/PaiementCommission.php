<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementCommission extends Model
{
    use HasFactory;
    protected $fillable = ['date_paiement','montant','reference','commission_id','utilisateur_id'];
}
