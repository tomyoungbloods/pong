<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function player()
    {
        return $this->belongsTo('App\Player');
    }
}
