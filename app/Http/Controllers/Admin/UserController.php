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
            'headImg' => $request -> input('headImg'),
            'created_at' => time(),
        ]);
        if($res){
            echo 'success';
        }
    }

    public function apiUserInfo(Request $request){
        $res = DB::table('user') -> where([
            'openid' => $request -> input('openid')
        ]) -> orWhere([
            'id' => $request -> input('id')
        ]) ->  first();
        if(!count($res)){
            return response() -> json($res);
        }

        if($res -> school_id){
            $res -> school_info = DB::table('school') -> where([
                'id' => $res -> school_id
            ]) -> first();
        }
        if($res -> zhuanye_id){
            $res -> zhuanye_info = DB::table('setting') -> where([
                'id' => $res -> zhuanye_id
            ]) -> first();
        }
        if($res -> hangye){
            $res -> hangye_info = DB::table('setting') -> where([
                'id' => $res -> hangye
            ]) -> first();
        }

        return response() -> json($res);
    }
    public function getOpenGid(Request $request){
        $appid = $request->input('appid');
        $sessionKey = $request->input('sessionKey');
        $encryptedData = $request->input('encryptedData');
        $iv = $request->input('iv');
        $alumniId = $request->input('alumniId');
        $openid = $request->input('openid');

        if(strlen($sessionKey) != 24){
            return '-41003';
        }
        if(strlen($iv)!=24){
            return '-41003';
        }
        $aesKey=base64_decode($sessionKey);
        $aesIV=base64_decode($iv);
        $aesCipher=base64_decode($encryptedData);
        $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
//        return response() -> json($result);
        $dataObj=json_decode( $result );
        if($dataObj == null){
            return '-41003';
        }
        if( $dataObj->watermark->appid != $appid){
            return '-41003';
        }
        if($alumniId) {
            if(!$openid)  return 'openidfail';
            $ismanage = DB::table('list')->where([
                'xiaoyou_id' => $alumniId,
                'openid' => $openid
            ]) ->first();
            if($ismanage->is_manage == 0) return 'notmanage';
            $info = DB::table('xiaoyouhui')->where('id', $alumniId)->first();
            if($info && ($info->wx_name != '' && $info->wx_name != null)){
                return 'isbuild';
            }
            $res = DB::table('xiaoyouhui')
                ->where('id', $alumniId)
                ->update(['wx_name' => $dataObj->openGId]);
        }
        return response() -> json($result);
    }
    public function getopenID(Request $request){
        $sessionKey = $request->input('sessionKey');
        $encryptedData = $request->input('encryptedData');
        $iv = $request->input('iv');

        if(strlen($sessionKey) != 24){
            return '-41001';
        }
        if(strlen($iv)!=24){
            return '-41002';
        }
        $aesKey=base64_decode($sessionKey);
        $aesIV=base64_decode($iv);
        $aesCipher=base64_decode($encryptedData);
        $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
        return response() -> json($result);
    }
}
