<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shequ extends Model
{
    protected $table = 'shequ';
    protected $fillable = ['title','number_lou','name','tel'];

    public $timestamps = true;

    public  function getDateFormat(){
        return time();
    }

    public  function asDateTime($value){
        return $value;
    }
}
