<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    //获取活动列表
    public function apiActivityList(Request $request){

        $openid = $request -> input('openid');
        $res_make = DB::table('activity') -> where([
            'openid' => $openid,
            'flag' => 0
        ]) -> get();
        return response() -> json($res_make);

    }
    //添加活动
    public function apiAddActivity(Request $request){
        $id_res = DB::table('activity') -> insertGetId([
            'title' => $request -> input('title'),
            'content' => $request -> input('content'),
            'xiaoyou_id' => $request -> input('xiaoyou_id'),
            'date' => $request -> input('date'),
            'time' => $request -> input('time'),
            'address' => $request -> input('address'),
            'openid' => $request -> input('openid'),
            'created_at' => time()
        ]);

        //添加报名信息
        DB::table('baoming') -> insert([
            'huodong_id' => $id_res,
            'openid' => $request -> input('openid'),
            'created_at' => time()
        ]);


        if($id_res){
            echo 'success';
        }else{
            echo 'error';
        }

    }

    //编辑活动
    public function apiEditActivity(Request $request){
        $res = DB::table('activity') -> where([
            'id' => $request -> input('id')
        ]) -> update([
            'title' => $request -> input('title'),
            'content' => $request -> input('content'),
            'xiaoyou_id' => $request -> input('xiaoyou_id'),
            'date' => $request -> input('date'),
            'time' => $request -> input('time'),
            'address' => $request -> input('address'),
            'openid' => $request -> input('openid'),
        ]);
    }

    //活动报名
    public function apiBaoming(Request $request){
        $res = DB::table('baoming') -> insert([
            'huodong_id' => $request -> input('huodong_id'),
            'openid' => $request -> input('openid'),
            'openid_yaoqing' => $request -> input('openid_yaoqing'),

        ]);
    }

    public function index(){
        echo '正在开发中';
    }


}
