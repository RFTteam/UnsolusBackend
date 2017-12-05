<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'GameName','Shortname'
    ];
    
    public function gamerinfo()
    {
        return $this->hasMany('App\Gamerinfo');
    }

    public function team()
    {
        return $this->hasMany('App\Team');
    }
    
}
