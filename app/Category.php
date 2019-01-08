<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UpdateGenericClass;

class Category extends Model
{
    use UpdateGenericClass;

    protected $fillable = ['name', 'description'];

    public function posts()
    {
        // Получить статьи блога.
        return $this->hasMany(Post::class);
    }

}
