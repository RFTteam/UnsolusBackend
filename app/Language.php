<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table='languages';
    protected $fillable = [
        'LanguageName','LanguageCode'
    ];
    
    public function user()
    {
        return $this->hasMany('App\User');
    }
    public function team()
    {
        return $this->hasMany('App\Team');
    }
}
