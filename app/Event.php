<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
        
        return $this->hasMany('App\Media');
    }
}
