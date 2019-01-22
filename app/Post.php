<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Sluggable;
    use Searchable;
    
    protected $fillable = [
        'title', 'content', 'is_active', 'category_id'
    ];
    
    protected $touches = ['tags'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function pictures()
    {
        return $this->belongsToMany(Picture::class);
    }

    public function shouldBeSearchable()
    {
        return $this->is_active;
    }
 

}
