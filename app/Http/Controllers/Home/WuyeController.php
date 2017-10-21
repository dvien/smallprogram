<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WuyeController extends Controller
{
    //
    public function login(){
        //dd(session());
        if(session('login_type') == 'wuye' && session('xiaoqu') && session('username')){
            return redirect('home/wuye/index');
        }
        return view('home/wuye/login');
    }

    public function loginRes(Request $request){
        //dd($request);
        $res = DB::table('business') -> where([
            'username' => $request -> input('username'),
            'password' => $request -> input('password'),
            'type' => 1
        ]) -> first();
        if($res){
            //保存物业用户名称
            session([
                'username' => $request -> input('username'),
                'xiaoqu' => $res -> xiaoqu,
                'login_type' => 'wuye'
            ]);
            echo 'success';
        }else{
            echo 'error';
        }
    }

    public function index(){
        //把未解决的news找出来
        //$where['type'] = 0;
        //$where['status'] = 0;
        $res = DB::table('news') -> where(function($query){
            $query -> where('type','=','0');
            $query -> where('status','=','0');
            $query -> where('huifu','<>','');
            $query -> where('xiaoqu','=',session('xiaoqu'));
        })  -> get();
        //dd($res);
        $res = $this -> object_array($res);
        foreach($res as $k=> $vo){
            if($vo['img']){
                $res[$k]['img'] = explode(',',$vo['img']);
            }

            $res[$k]['userinfo'] = DB::table('user') -> where([
                'openid' => $vo['openid'],
            ]) -> first();

            //查找每条的物业回复
            $res[$k]['wuyehuifu']=DB::table('wuye_huifu') -> where([
                'news_id' => $vo['id']
            ]) -> get();
        }
        //dd($res);
        return view('home/wuye/index') -> with([
            'res' => $res
        ]);
    }

    public function wuyehuifu(Request $request){
        //存储物业回复
        DB::table('wuye_huifu') -> insert([
            'news_id' => $request -> input('id'),
            'content' => $request -> input('content'),
            'imgs' => $request -> input('img'),
            'username' => session('username')
        ]);
        echo 'success';
    }

    public function jiejue(Request $request){
        DB::table('news') -> where([
            'id'=> $request -> input('id')
        ]) -> update([
            'status' => '1'
        ]);
        echo 'success';
    }


}
