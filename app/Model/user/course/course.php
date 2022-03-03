<?php

namespace App\Model\user\course;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    public function users()
    {
        return $this -> belongsToMany('App\Model\user\User' , 'course_users')->withTimestamps();
    }
}
