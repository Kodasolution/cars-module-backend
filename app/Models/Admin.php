<?php

namespace App\Models;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * Get the user that owns the Admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the entreprise that owns the Admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
