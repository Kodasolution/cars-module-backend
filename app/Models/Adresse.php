<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;
    protected $table="adresses";
    protected $fillable = ['pays','province','commune','quartier','rue','numero'];
}
