<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $guarded =
    [
        'id',
    ];

    public function articles()
    {
        return $this->belongsToMany('App\Models\Article')->withTimestamps();
    }
}
