<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id'
    ];

    public static function slugGenerator($title){
        $slug = Str::slug($title, '-');
        $original_slug = $slug;

        $post_esistente = Post::where('slug', $slug)->first();
        $c = 1;
        while($post_esistente){
            $slug = $original_slug . '-' . $c;
            $c++;
            $post_esistente = Post::where('slug', $slug)->first();
        }

        return $slug;
    }
}
