<?php

namespace App\Http\Controllers\Admin;

use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ActivityController extends Controller
{
    //获取活动列表
    public function apiActivityList(Request $request){

        $openid = $request -> input('openid');
        $res_make = DB::table('activity') -> where([
            'openid' => $openid,
            'flag' => 0
        ])-> get();
        $weekarray=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
        if($res_make){
            foreach($res_make as $k =>$vo){
                $vo -> day = date('d',strtotime($vo -> date));
                $week = date('w',strtotime($vo -> date));
                $vo -> week = $weekarray[$week];
            }
        }
        return response() -> json($res_make);

    }
    //添加活动
    public function apiAddActivity(Request $request){
        if($request -> input('id') == 0){
            $id_res = DB::table('activity') -> insertGetId([
                'title' => $request -> input('title'),
                'content' => $request -> input('content'),
                'xiaoyou_id' => $request -> input('xiaoyou_id'),
                'date' => $request -> input('date'),
                'time' => $request -> input('time'),
                'address' => $request -> input('address'),
                'openid' => $request -> input('openid'),
                'baoming' => 1,
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
        }else{
            DB::table('activity')
                ->where('id', $request -> input('id'))
                ->update([
                    'title' => $request -> input('title'),
                    'content' => $request -> input('content'),
                    'xiaoyou_id' => $request -> input('xiaoyou_id'),
                    'date' => $request -> input('date'),
                    'time' => $request -> input('time'),
                    'address' => $request -> input('address'),
                ]);
        }
    }
    //删除活动
    public function deleteActivity($id){
        DB::table('activity') -> where([
            'id' => $id
        ]) -> delete();
        DB::table('baoming') -> where([
            'huodong_id' => $id
        ]) -> delete();
        echo 'success';
    }
    //活动详情
    public function apiActivityDetail(Request $request){
        $res = DB::table('activity') -> where([
            'id' => $request -> input('id')
        ]) -> first();
        if($res){
            $res -> userinfo = DB::table('user') -> where([
                'openid' => $res -> openid
            ]) -> first();
            $res -> xiaoyouinfo = DB::table('xiaoyouhui') -> where([
                'id' => $res -> xiaoyou_id
            ]) -> first();
            //返回此人是否报名过
            if($request -> input('openid')){
                $temp = DB::table('baoming') -> where([
                    'huodong_id' => $request -> input('id'),
                    'openid' => $request -> input('openid')
                ]) -> first();
                if($temp){
                    $res -> is_baoming = 1;
                }
            }
            $res -> baominguser = DB::table('baoming')
                ->leftJoin('user', 'user.openid', '=', 'baoming.openid')
                ->select('baoming.*', 'user.name')
                -> where([
                'baoming.huodong_id' => $request -> input('id')
            ]) -> get();
            foreach($res -> baominguser as $k =>$vo){
                $vo -> created_at = date('Y/m/d  H:i',$vo -> created_at);
            }
            return response() -> json($res);
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
        //先查下他有没有报名
        $isset = DB::table('baoming') -> where([
            'huodong_id' => $request -> input('huodong_id'),
            'openid' => $request -> input('openid'),
        ]) -> first();
        if($isset){
            echo 'isset';exit;
        }
        $res = DB::table('baoming') -> insert([
            'huodong_id' => $request -> input('huodong_id'),
            'openid' => $request -> input('openid'),
            'openid_yaoqing' => $request -> input('openid_yaoqing'),
            'created_at' => time(),
        ]);
        //活动报名人数+1
        DB::table('activity')-> increment('baoming') -> where([
            'id' => $request -> input('huodong_id'),
        ]);
        echo 'success';
    }

    public function uploadImg(Request $request){
        if($_FILES['file']){
            $photos = $_FILES['file'];
        }
        echo 'fail';
    }
    public function index(){
        echo '正在开发中';
    }


}
