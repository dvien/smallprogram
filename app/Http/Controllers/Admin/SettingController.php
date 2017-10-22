<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    //api
    public function settingApi($type){
        $res = DB::table('setting') -> where([
            'type' => $type
        ]) -> get();
        return response() -> json($res);
    }
    public function index($type){
        $res = DB::table('setting') -> where([
            'type' => $type
        ]) -> paginate(15);
        switch ($type){
            case 0:$typename = '专业信息';break;
            case 1:$typename = '行业信息';break;
            case 2:$typename = '爱好标签';break;
            case 3:$typename = '邀请码';break;
        }
        return view('admin/setting/index') -> with([
            'res' => $res,
            'type' => $type,
            'typename' => $typename
        ]);
    }

    public function addSettingRes(Request $request){
        //先查有没有重复
        $isset = DB::table('setting') -> where([
            'name' => $request -> input('name'),
            'type' => $request -> input('type'),
        ]) -> first();
        //dd($isset);exit;
        if($isset){
            return redirect('admin/setting/'.$request -> input('type')) -> with([
                'isset' => 'yes'
            ]);
        }
        $res = DB::table('setting') -> insert([
            'name' => $request -> input('name'),
            'type' => $request -> input('type'),
            'created_at' => time()
        ]);

        return redirect('admin/setting/'.$request -> input('type')) -> with('insertres','success');
    }

    //删除
    public function deleteSetting($id,$type){
        $res = DB::table('setting') -> where([
            'id' => $id
        ]) -> delete();
        if($res){
            return redirect('admin/setting/'.$type) -> with([
                'deleteres' => 'yes'
            ]);
        }
    }
}
