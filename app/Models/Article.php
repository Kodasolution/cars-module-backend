<?php

namespace App\Models;

use App\Models\Favory;
use App\Models\Photos;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected  $guarded=[];

        /**
     * Get all of the Photos for the Voiture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Photos()
    {
        return $this->hasMany(Photos::class, 'article_id', 'id');
    }

    public function entreprise()
    {
    return $this->belongsTo(Entreprise::class);
    }

    /**
     * Get the user that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function favories()
    {
        return $this->hasMany(Favory::class,"article_id");
    }



}
