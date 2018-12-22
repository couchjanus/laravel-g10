<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function posts()
    {
        // Получить статьи блога.
        // return $this->hasMany('App\Post');
        return $this->hasMany(Post::class);
    }

}
