<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function apiAddUser(Request $request){
        //先查下openid 存在不存在
        $isset = DB::table('user') -> where([
            'openid' => $request -> input('openid')
        ]) -> first();
        if($isset){
            echo 'isset';exit;
        }

        //存储
        $res = DB::table('user') -> insert([
            'openid' => $request -> input('openid'),
        ]);
        echo 'success';

    }

    public function index(){
        $res = DB::table('user') -> paginate(15);
        return view('admin/user/index') -> with([
            'res' => $res
        ]);
    }

    public function userdetail($id){
        $res = DB::table('user') -> where([
            'id' => $id
        ]) -> first();
        return view('admin/user/userdetail') -> with([
            'res' => $res
        ]);
    }

    //编辑用户名片提交接口
    public function apiEditUser(Request $request){
        $res = DB::table('user') -> where([
            'openid' => $request -> input('openid')
        ]) -> update([
            'name' => $request -> input('name'),
            'tel' => $request -> input('tel'),
            'wx_number' => $request -> input('wx_number'),
            'school_id' => $request -> input('school_id'),
            'zhuanye_id' => $request -> input('zhuanye_id'),
            'xueli' => $request -> input('xueli'),
            'school_time' => $request -> input('school_time'),
            'banji' => $request -> input('banji'),
            'company' => $request -> input('company'),
            'zhiwei' => $request -> input('zhiwei'),
            'hangye' => $request -> input('hangye'),
            'content' => $request -> input('content'),
            'address' => $request -> input('address'),
            'birthday' => $request -> input('birthday'),
            'aihao' => $request -> input('aihao'),
            'created_at' => time(),
        ]);
        if($res){
            echo 'success';
        }
    }

    public function apiUserInfo(Request $request){
        $res = DB::table('user') -> where([
            'openid' => $request -> input('openid')
        ]) -> first();
        $res -> school_info = DB::table('school') -> where([
            'id' => $res -> school_id
        ]) -> first();
        $res -> zhuanye_info = DB::table('setting') -> where([
            'id' => $res -> zhuanye_id
        ]) -> first();
        return response() -> json($res);
    }

}
