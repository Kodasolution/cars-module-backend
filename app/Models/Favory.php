<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favory extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
     * Get all of the comments for the Favory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article()
    {
        return $this->belongsTo(Article::class,'article_id','id');
    }
}
