<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function checkLogin($code){
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wx013cd1f748536bc7&secret=0870cf68faef93d81e505bd0380a8da0&js_code='.$code.'&grant_type=authorization_code';
        $result = file_get_contents($url);
        return response() -> json($result);
    }

}
