<?php

namespace App\Http\Controllers\Home;

use App\WxModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{

    public function indexJump(){
        $url = urlencode('http://m.tianluyangfa.com/laravel/public/home/market');

        $appId = 'wx68099d0c30ed4f39';

        $trueurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appId."&redirect_uri=".$url."&response_type=code&scope=snsapi_base&state=state#wechat_redirect";
        //echo 11;exit;
        //dump($trueurl);
        //Header("Location: $trueurl");
        header("Location: $trueurl");exit;
    }

    //跳蚤市场
    public function index(){
        $model = new WxModel();
        $mark = $model -> checkOpenid();
        $res = DB::table('news') -> where(['type'=>4])->get();
        $res = $this -> object_array($res);

        //$this -> dump($res);exit;


        foreach($res as $k=> $vo){
            if($vo['img']){
                $res[$k]['img'] = explode(',',$vo['img']);
            }

            $res[$k]['userinfo'] = DB::table('user') -> where([
                'openid' => $vo['openid'],
            ]) -> first();
            if($vo['status'] == 0){
                $res[$k]['status'] = '待解决';
            }else{
                $res[$k]['status'] = '已解决';
            }

        }
        //dd($res);

        return view('home/market')->with([
            'res' => $res
        ]);
    }

    //发布
    public function fabu(){


        return view('home/fabu') -> with([
            'index' => 4
        ]);
    }



    //发布结果
    public function fabuRes(Request $request){
        //先查下上条发的时间
        $lastnews = DB::table('news') -> where([
            'openid' => session('openid')
        ]) ->orderBy('created_at','desc')-> first();
        if($lastnews && time() - $lastnews -> created_at <= 30){
            echo 'error';exit;
        }

        //存储到news表中
        $model = new News();
        $model -> type = $request -> input('index');
        $model -> title = $request -> input('title');
        $model -> label = $request -> input('label');
        $model -> miaoshu = $request -> input('content');
        $model -> img = $request -> input('img');
        $model -> date = $request -> input('date');
        $model -> price = $request -> input('price');
        $model -> openid = session('openid');


        $res = $model -> save();
        echo 'success';
    }

}
