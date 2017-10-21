<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'admin';
    protected $fillable = ['username','password','type','status'];

    public $timestamps = true;

    public  function getDateFormat(){
        return time();
    }

    public  function asDateTime($value){
        return $value;
    }
}
