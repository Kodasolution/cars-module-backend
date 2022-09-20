<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuperAdmin extends Model
{
    use HasFactory;
    protected $table ="super_admins";
    protected $guarded=[];
    /**
     * Get the user that owns the SuperAdmin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
