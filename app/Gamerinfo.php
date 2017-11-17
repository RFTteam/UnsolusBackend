<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamerinfo extends Model
{
    protected $table='Gamerinfo';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'GamerName','GameId','UserId','Rank','Role','Region'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function game()
    {
        return $this->belongsTo('App\Game');
    }
    
}
