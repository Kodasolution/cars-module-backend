<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVoiture extends Model
{
    use HasFactory;
    protected $table="type_voitures";
    protected $fillable = ['type'];
}
