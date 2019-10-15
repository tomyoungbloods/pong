<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        "name", "points", "checked", 'profile_image'
    ];
    /**
     * Get Point records associated with Player
     */
    public function Points()
    {
        return $this->hasMany('App\Point');
    }
    /**
     * Get Point records associated with Player
     */
    public function file()
    {
    return $this->hasOne('App\File', 'player_id');
    }

    protected function getTotalPoints() {
        $points = $this->Points;
        $total = 0;
        foreach($points as $point) {
            $total = $total + $point->points;
        }
        return $total;
    }
    public function getTotalPointsAttribute() {

        return $this->getTotalPoints();
        
        $sort->sortByPoints(function ($total_points){
            return $sort->player->total_points();
        }); 
    }

    protected function getPlayerAvatarUrl() {
        if($this->file()->exists()) {
            ($this->file->file_name);
            return '/storage/' . $this->file->folder_name . '/' . $this->file->file_name;
        } else {
            return '/img/default-avatar.jpg';
        }
    }
    public function getAvatarUrlAttribute() {
        return $this->getPlayerAvatarUrl();
    }
}

