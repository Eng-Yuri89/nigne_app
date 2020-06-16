<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{


    protected $table = 'countries';
    protected $primaryKey = 'id';


    public function cities(){
        return $this->hasMany(City::class );//, 'cities_id' , 'id');
    }

    public function states(){
    return  $this->hasMany(State::class );//, 'states_id' , 'id');
    }


}
