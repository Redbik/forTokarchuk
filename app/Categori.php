<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function Novostis(){
        return $this->hasMany('App\Novosti', 'categoris_id');
    }
}
