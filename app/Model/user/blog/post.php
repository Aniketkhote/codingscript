<?php

namespace App\Model\user\blog;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class post extends Model
{
    use Commentable;

    public function tags()
    {
        return $this -> belongsToMany('App\Model\user\blog\tag' , 'tag_posts')->withTimestamps();
    }

    public function categories()
    {
        return $this -> belongsToMany('App\Model\user\blog\category' , 'category_posts')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
