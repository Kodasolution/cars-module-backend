<?php

namespace App\Models;

use App\Models\Marque;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modele extends Model
{
    use HasFactory;
    protected $table="modele";
    // protected $fillable = ['modele'];
    protected $guarded=[];
    /**
     * Get the marque that owns the Modele
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }
}
