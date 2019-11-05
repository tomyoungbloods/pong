<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = [
        'winner_category_id',
        'player_id',
        'position',
    ];
}
