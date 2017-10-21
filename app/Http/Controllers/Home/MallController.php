<?php

namespace App\Http\Controllers\Home;

use App\WxModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MallController extends Controller
{
    public function indexJump(){
        $url = urlencode('http://m.tianluyangfa.com/laravel/public/home/mall');

        $appId = 'wx68099d0c30ed4f39';

        $trueurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appId."&redirect_uri=".$url."&response_type=code&scope=snsapi_base&state=state#wechat_redirect";
        //echo 11;exit;
        //dump($trueurl);
        //Header("Location: $trueurl");
        header("Location: $trueurl");exit;
    }

    //商城
    public function index(){
        $model = new WxModel();
        $model -> checkOpenid();
        //轮播
        $res_lunbo = DB::table('lunbo') -> get();
        $res = DB::table('goods') -> get();

        //分类
        $res_fenlei = DB::table('fenlei') -> get();

        //dd($res);
        return view('home/mall')->with([
            'res' => $res,
            'res_lunbo' => $res_lunbo,
            'res_fenlei' => $res_fenlei
        ]);
    }


    public function malldetail($id){
        $res = DB::table('goods') -> where(['id'=>$id]) -> first();
        if($res -> imgs){
            $res -> imgs = explode(',',$res -> imgs);
        }
        //dd($res);
        return view('home/malldetail') -> with([
            'res' => $res
        ]);
    }

    public function buynow($id,$number){
        //dd(session('openid'));
        $res = DB::table('goods') -> where(['id'=>$id]) -> first();
        return view('home/mall/buynow') -> with([
            'res' => $res,
            'number' => $number
        ]);
    }

    //支付
    public function payAjax(Request $request){
        //dd($request);
        $res = DB::table('order') -> insert([
            'goods_id' => $request -> input('id'),
            'number' => $request -> input('number'),
            'address' => '上海市浦东新区',
            'remark' => $request -> input('remark'),
            'created_at' => time(),
            'updated_at' => time(),
            'openid' => session('openid'),
            'order_id' => time().rand(1000,9999),
            'fukuan_status' => 1,
            'show_status' => '待收货',
        ]);
        echo 'success';


    }



}
