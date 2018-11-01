<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
