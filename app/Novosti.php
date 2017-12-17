<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novosti extends Model
{
    //
    protected $fillable = [
        'namenew','categoris_id','shorttext','fultext','foto','AddUser'
    ];

//    protected $attributes = [
//      //'published' => '0'
//    ];


    public function categories(){
        return $this->hasOne('App\Categori','id','categoris_id');
    }
}
