<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['name', 'file_name'];

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

}
