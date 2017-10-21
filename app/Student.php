<?php
/**
 * Created by PhpStorm.
 * User: richer
 * Date: 2017/8/3
 * Time: 下午10:17
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'student';

    protected $fillable = ['name','age','addtime'];

    public $timestamps = false;

    protected function getDateFormat(){
        return time();
    }

    protected function asDateTime($value){
        return $value;
    }
}