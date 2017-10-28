<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table='countries';
    
    protected $fillable = [
        'CountryName','CountryCode'
    ];
    
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
