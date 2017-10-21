<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    protected $table = 'business';
    protected $fillable = ['username','password','type','status'];

    public $timestamps = true;

    public  function getDateFormat(){
        return time();
    }

    public  function asDateTime($value){
        return $value;
    }
}
