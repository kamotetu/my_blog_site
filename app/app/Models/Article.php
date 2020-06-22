<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $guarded = 
    [
        'id',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre')->withTimestamps();
    }
}
