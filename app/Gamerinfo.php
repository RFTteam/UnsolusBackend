<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamerinfo extends Model
{
    protected $table='Gamerinfo';
    protected $primaryKey ='GamerId';
    public $timestamps = true;
    protected $game;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'GamerName','GameId','UserId','Rank','Role','Region','Server','Motivation'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'UserID','GameID','created_at','updated_at',
    ];

    protected $appends = ['game'];

    public function getGameAttribute()
    {
        return $this->game;
    }

    public function setGame($value)
    {
        $this->game=$value;
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function game()
    {
        return $this->belongsTo('App\Game');
    }
    
}
