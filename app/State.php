<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $primaryKey = 'id';

    public function cities()
    {
        return $this->hasMany(City::class);//, 'id', 'cities_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);//, 'id', 'country_id');
    }
}
