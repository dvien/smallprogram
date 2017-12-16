<?php

namespace App\Http\Controllers\Admin;

use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ActivityController extends Controller
{
    //保存图片
    public  function saveImg(Request $request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('file')){
            echo 'error';exit;
        }
        $imgsrc = $request -> input('imgsrc');
        if($imgsrc){
            $imgsrc = explode(',',$imgsrc);
        }
        $file = $request->file('file');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错！');
        }

        $newFileName = md5(time().rand(0,10000)).'.'.$file->getClientOriginalExtension();
        /*
        $savePath = $newFileName;
        $bytes = Storage::put(
            $savePath,
            file_get_contents($file->getRealPath())
        );
        */
        $res = $rew = \Intervention\Image\Facades\Image::make(file_get_contents($file->getRealPath()))->resize(450,220)->save(public_path().'/images/activity/'.$newFileName,80 );
        /*
        if(!Storage::exists($savePath)){
            exit('保存文件失败！');
        }
        */
        $imgsrc[] = $newFileName;
        $returndata['imgsrc'] =  implode(',',$imgsrc);
        $returndata['img'] = $newFileName;
        //header("Content-Type: ".Storage::mimeType($savePath));
        return response() -> json($returndata);
        //echo $newFileName;
        //echo Storage::get($savePath);
    }

    //获取活动列表
    public function apiActivityList(Request $request){

        $openid = $request -> input('openid');
        $res_make = DB::table('baoming')
            ->select('activity.*', 'baoming.id as baomingid')
            ->leftjoin('activity','activity.id','=','baoming.huodong_id')
            ->where(['baoming.openid'=>$openid])
            ->orderBy('activity.date','asc')
            ->get();
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
                'imgsrc' => $request -> input('imgsrc'),
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
                    'imgsrc' => $request -> input('imgsrc'),
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
        DB::table('activity')-> where([
            'id' => $request -> input('huodong_id'),
        ])-> increment('baoming');
        echo 'success';
    }
    public function index(){
        $res = DB::table('activity') -> paginate(15);

        foreach($res as $k => $vo){
            $vo -> xiaoyou_info =  DB::table('xiaoyouhui') -> where([
                'id' => $vo -> xiaoyou_id
            ]) -> first();
            $vo -> user_info = DB::table('user') -> where([
                'openid' => $vo -> openid
            ]) -> first();
        }



        return view('admin/activity/index') -> with([
            'res' => $res
        ]);
    }


}
