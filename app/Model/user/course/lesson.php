<?php

namespace App\Model\user\course;

use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
