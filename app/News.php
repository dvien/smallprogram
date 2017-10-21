<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['type','title','label','img','miaoshu','price','date','date_right','liulan','dianzan'];

    public $timestamps = true;

    public  function getDateFormat(){
        return time();
    }

    public  function asDateTime($value){
        return $value;
    }

}
