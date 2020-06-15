<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id';


    public function country()
    {
        return $this->belongsTo(Country::class, 'id', 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'id', 'state_id');
    }
}
