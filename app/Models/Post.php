<?php

namespace App\Models;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory, Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function getAuthor(){
        return $this->belongsTo(User::class,'author_id','id');
    }
    public function getCategory(){
        return $this->belongsTo(Category::class,'category','id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'post_id');
    }
    public function replies(){
        return $this->hasMany(Comment::class,'post_id');
    }
}
