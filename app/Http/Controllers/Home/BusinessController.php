<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


//商户登陆
class BusinessController extends Controller
{
    //
    public function login(){
        if(session('login_type') == 'business'){
            $res = DB::table('business') -> where([
                'username' => session('username'),
                'password' => session('password'),
                'status' => 0,
                'type' => 0
            ]) -> first();
            if($res){
                return redirect('home/business/index');
            }
        }
        return view('home/business/login');
    }

    public function loginRes(Request $request){
        //dd($request);
        $res = DB::table('business') -> where([
            'username' => $request -> input('username'),
            'password' => $request -> input('password'),
            'status' => 0,
            'type' => 0
         ]) -> first();
        if($res){
            //保存 此商户的username
            session([
                'username' => $res -> username,
                'password' => $res -> password,
                'login_type'=>'business',

            ]);
            echo 'success';
        }else{
            echo 'error';
        }
    }

    public function index($ids = null){
        //我的客户
        //dd(session('username'));
        //找他自己的服务
        $myservice = DB::table('service') -> where([
            'username' => session('username')
        ]) -> orderBy('created_at','desc') -> get();
        $newarr = [];
        $titlearr = [];

        //通过服务小区号 找到小区
        if(count($myservice)){
            foreach($myservice as $k => $vo){
                $service_ids[] = $vo -> id;
            }
            $mycustomer = DB::table('boda_service') -> whereIn(
                'service_id',$service_ids
            ) -> get();
            foreach($mycustomer as $k => $vo){
                $mycustomer[$k] -> userinfo = DB::table('user') -> where([
                    'openid' => $vo -> openid
                ]) -> first();
            }

            //我发布的服务
            //将自己的服务分组
            $newarr = array();
            foreach($myservice as $vo){
                $newarr[$vo->created_at][] = $vo;
                $titlearr[$vo->created_at]['title'] = $vo -> title;
                $titlearr[$vo->created_at]['tel'] = $vo -> tel;
            }
            //dd($newarr);
            //找服务下小区的名称
            foreach($newarr as $k => $vo){

                foreach($vo as $key => $vol){
                    $vo[$key]->xiaoquinfo = DB::table('shequ') -> where([
                        'id' => $vol -> xiaoqu
                    ]) -> first();
                }
                //dd($vo);
            }

        }else{
            $mycustomer = null;
        }


        $select_res = DB::table('shequ') -> get();



        //dd($newarr);
        return view('home/business/index')->with([
            'select_res' => $select_res,
            'mycustomer' => $mycustomer,
            'newarr' => $newarr,
            'titlearr' => $titlearr
        ]);
    }

    //发布服务
    public function fabufuwu($ids = null){
        $newarr = array();
        if($ids){
            $ids = explode(',',$ids);
            foreach($ids as $vo){
                $newarr[] = DB::table('shequ') -> where([
                    'id' => $vo
                ]) -> first();
            }
            //dd($newarr);
        }
        return view('home/business/fabu') ->with([
            'newarr' => $newarr
        ]);
    }
    //发布服务选择小区
    public function selectxiaoqu(){
        $res = DB::table('shequ') -> get();
        return view('home/business/selectxiaoqu') -> with([
            'res' => $res
        ]);
    }

    public function fabuRes(Request $request){
        $ids = $request -> input('ids');
        $ids = explode(',',$ids);
        foreach($ids as $vo){
            //插入 service
            DB::table('service') -> insert([
                'title' => $request -> input('servicename'),
                'username' => session('username'),
                'tel' => $request -> input('tel'),
                'type' => $request -> input('type'),
                'created_at' => time(),
                'updated_at' => time(),
                'xiaoqu' => $vo,
                'boda' => 0,
                'dianzan' => 0
            ]);
        }
        echo 'success';

    }
}
