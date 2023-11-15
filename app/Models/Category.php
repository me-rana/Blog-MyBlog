<?php

namespace App\Models;

use App\Models\Post;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory, Sluggable;
    public function sluggable(): array
    {
        return [
            'cat_slug' => [
                'source' => 'cat_name'
            ]
        ];
    }
    public function getPosts(){
        return $this->hasMany(Post::class,'category','id');
    }
}
