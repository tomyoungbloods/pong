<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [

        "naam", "punten", "aanwezig", 'profile_image'
        
    ];
}
