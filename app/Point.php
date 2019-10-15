<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    /**
     * The attribute that is table.
     *
     * @var string
     */
    protected $table = 'points';

    /**
     * PlayerPoint belongs to Speler.
     */
    public function player()
    {
        return $this->belongsTo('App\Player');
    }
}