<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $primaryKey ='TeamID';
    public $timestamps = true;
    protected $language;
    protected $country;


    protected $fillable = [
        'Teamname','Teamgoal','CountryID','LanguageID','Server'
    ];

    protected $hidden = [
        'CountryID','LanguageID','created_at','updated_at',
    ];

    protected $appends = ['country','language'];

    public function getCountryAttribute()
    {
        return $this->country;

    }
    public function getLanguageAttribute()
    {
        return $this->language;

    }
    public function setCountry($value)
    {
        $this->country= $value;
    }
    public function setLanguage($value)
    {
        $this->language = $value;
    }



    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
    public function teammember()
    {
        return $this->hasMany('App\Teammember');
    }
}
