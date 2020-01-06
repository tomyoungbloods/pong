<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Point;
use App\Winner;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name", "points", "checked", 'profile_image', "winners"
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
    }

    protected function getPointsRatio(){
        $points = $this->points;
        $count = $points->count();

        $total = 1;
        $ratio = 1;
        foreach($points as $point) {
            $total = $total + $point->points;
            $ratio = round(($total / $count), 2); 
        }

        return $ratio;
    }

    public function getPointsRatioAttribute() {
        
        return $this->getPointsRatio();
    }
    
    
    protected function getTotalPauzePrices() {
        return Winner::where([['winner_category_id', 1],['player_id', $this->id],])->get()->count();
    }
    public function getTotalPauzePricesAttribute() {

        return $this->getTotalPauzePrices();
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

    protected function getLastFourGames() {
        
        $LastFourpoints = Point::where('player_id', $this->id)->orderBy('created_at', 'desc')->take(4)->get();

        $i = 0;
        $count = $LastFourpoints->count();
        $points_array = [];
        if($count < 4) {
            $amount = 4 - $count;
            for($j = 0; $j < $amount; $j++) {
                $points_array[] = 0;
            }
            foreach($LastFourpoints as $point) {
                $points_array[] = $point->points;
                
                $i++;
            }
        } else {
            foreach($LastFourpoints as $point) {
                $points_array[] = $point->points;
                
                $i++;
            }
        }
        $points_array = array_reverse($points_array);

        return implode(' - ', $points_array);
    }
    public function getLastFourGamesAttribute() {

        return $this->getLastFourGames();
    }
}

