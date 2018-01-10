<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dernek extends Model
{
    protected $table="dernekler"; //Bu model dernekler tablosuna ait
    public $timestamps=false;
    
    public function il(){
        return $this->hasOne('App\Iller', 'id','il_id');
    }
    public function ilce(){
        return $this->hasOne('App\Ilceler', 'id','il_id');
    }
    public function semt(){
        return $this->hasOne('App\Semt', 'id','ilce_id');
    }
    
}
