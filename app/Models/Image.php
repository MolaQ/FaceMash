<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',
        'filename',
        'country',
        'score',
        'wins',
        'losses',
        'rank',
    ];
}
