<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'winner',
        'loser'
    ];

    //CALCULATE THE EXPECTED SCORE OR OUTCOME 
    public static function expected($Rb, $Ra)
    {

        return 1 / (1 + pow(10, ($Rb - $Ra) / 400));
    }


    //CALCULATE THE NEW WINNER SCORE
    public static function win($score, $expected, $k = 24)
    {

        return $k * (1 - $expected) + $score;
    }

    //CALCULATE THE NEW LOSER SCORE
    public static function loss($score, $expected, $k = 24)
    {

        return $k * (0 - $expected) + $score;
    }

    //CALCULATE THE RANK
    public static function rank($score, $losses, $wins)
    {
        if (($losses == 0) || ($wins == 0) || ($losses == 0)) {
            return 0;
        }
        return ROUND($score / (1 + ($losses / ($wins))));
    }
}
