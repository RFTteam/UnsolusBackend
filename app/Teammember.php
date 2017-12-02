<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teammember extends Model
{
    protected $primaryKey ='TeammemberID';
    public $timestamps = true;

    protected $team;
    protected $gamerinfo;
    protected $appends = ['team','gamerinfo'];

    public function getTeamAttribute()
    {
        return $this->team;
    }

    public function setTeam($value)
    {
        $this->team=$value;
    }
    public function getGamerinfoAttribute()
    {
        return $this->gamerinfo;
    }

    public function setGamerinfo($value)
    {
        $this->gamerinfo=$value;
    }



    protected $fillable = [
        'TeamID','GamerID'
    ];
    protected $hidden = [
        'TeamID','GamerID','created_at','updated_at',
    ];

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function gamerinfo()
    {
        return $this->belongsTo('App\Gamerinfo');
    }
}
