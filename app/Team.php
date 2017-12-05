<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $primaryKey ='TeamID';
    public $timestamps = true;
    protected $language;
    protected $country;
    protected $game;


    protected $fillable = [
        'Teamname','Teamgoal','CountryID','LanguageID','Server','GameID'
    ];

    protected $hidden = [
        'CountryID','LanguageID','created_at','updated_at','GameID'
    ];

    protected $appends = ['country','language','game'];

    public function getCountryAttribute()
    {
        return $this->country;

    }
    public function getLanguageAttribute()
    {
        return $this->language;

    }
    public function getGameAttribute()
    {
        return $this->game;

    }
    public function setCountry($value)
    {
        $this->country= $value;
    }
    public function setLanguage($value)
    {
        $this->language = $value;
    }

    public function setGame($value)
    {
        $this->game = $value;
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
    public function game()
    {
        return $this->belongsTo('App\Game');
    }
    public function teammember()
    {
        return $this->hasMany('App\Teammember');
    }
}
