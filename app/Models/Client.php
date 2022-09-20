<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients";
    protected $guarded = [];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    /**
     * Get all of the locations for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany(Location::class, 'client_id');
    }
}
