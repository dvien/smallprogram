<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function login(){
        return view('admin/login');

    }
    public function loginout(Request $request){
        $request->session()->flush();
        return redirect('admin/login');
    }

    public function loginRes(Request $request){
        $username = $request -> input('username');
        $password = $request -> input('password');
        $res = DB::table('admin') -> where([
            'username'=>$username,
            'password'=>$password,
            'type' => $request -> input('type'),
            'status' => 0
        ]) -> first();
        $res = (array)$res;
        if($res){
            //登陆次数加一
            DB::table('admin') -> where([
                'id' => $res['id']
            ]) -> increment('logintime');
            session([
                'username' => $res['username'],
                'type' => $res['type'], //0平台管理员 1社区管理员
                'xiaoqu' => $res['xiaoqu'],
            ]); //储存登陆标志
            if($res['type'] == 1){
                return redirect('admin/yonghu/1')->with('status', 'success');
            }
            return redirect('admin/numberBack')->with('status', 'success');
        }else{
            return redirect('admin/login')->with('status', 'error');
        }
        //var_dump($res);
    }

    public function index(Request $request){
        if(!session('username')){
            return redirect('admin/login');
        }
        //dd(session('username'));
        return view('admin/index');
    }


}
