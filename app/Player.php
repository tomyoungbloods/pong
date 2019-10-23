<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name", "points", "checked", 'profile_image'
    ];
    /**
     * Get Point records associated with Player
     */
    public function points()
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
        $points = $this->points;
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

    public function pointsInPeriod($dates) {
        $points_in_period = $this->Points()->where([
            ['created_at', '>', $dates['start_date']],
            ['created_at', '<', $dates['end_date']],
        ])->get();
        $total_in_period = 0;
        foreach($points_in_period as $point) {
            $total_in_period = $total_in_period + $point->points;
        }

        return $total_in_period;
    }
}

