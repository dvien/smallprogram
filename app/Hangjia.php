<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hangjia extends Model
{
    protected $table = 'hangjia';
    protected $fillable = ['tel','name','title','content','img'];

    public $timestamps = true;

    public  function getDateFormat(){
        return time();
    }

    public  function asDateTime($value){
        return $value;
    }
}
