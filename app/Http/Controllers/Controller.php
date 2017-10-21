<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function object_array($array,$mark = null) {
        if(is_object($array)) {
            $array = (array)$array;
            //dump($array);exit;
        }
        if(is_array($array)) {
            foreach($array as $key=>$value) {
                $array[$key] = $this -> object_array($value,1);
            }
        }

        if(!$mark){
            foreach($array as $vo){
                $newarray = $vo;
            }

            return $newarray;
        }

        return $array;
    }


}
