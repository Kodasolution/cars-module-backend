<?php

namespace App\Models;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photos extends Model
{
    use HasFactory;
    protected $fillable = ['voiture_id','url_photo','principale'];

    /**
     * Get the Voiture that owns the Photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Voiture()
    {
        return $this->belongsTo(Voiture::class);
    }
}
