<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'unit','description','unit','price','total'
    ];

    public function images(){
        return $this->hasOne(Image::class);
    }
}
