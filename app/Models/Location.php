<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    protected $table="location";
    protected $fillable = ['date_location','montant_total','client_id'];

    /**
     * The voitures that belong to the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function voitures()
    {
        return $this->belongsToMany(Voiture::class, 'ligne_location_voiture', 'voiture_id', 'location_id');
    }
    /**
     * Get the client that owns the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
