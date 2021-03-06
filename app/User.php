<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Carbon\Carbon;
//use Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $primaryKey ='UserID';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Username','CountryID','LanguageID','Email','DateOfBirth','Password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password', 'remember_token','CountryID','LanguageID','created_at','updated_at',
    ];

    protected $year;
    protected  $country;
    protected $language;
    protected $appends = ['year','country','language'];

    public function getYearAttribute()
    {
        return $this->year;

    }
    public function setYear($value)
    {
        $this->year = $value;
    }

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



    public function gamerinfo()
    {
        return $this->hasMany('App\Gamerinfo');
    }
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
    
    public function getAuthPassword() {
        return $this->Password;
    }
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    /**
     * Return a key value array, containing any custom claims to be added to the JWT
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
