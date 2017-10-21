<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MyCenterController extends Controller
{
    //
    public function mylinli($openid = null){
        return view('home/mycenter/mylinli') -> with([
            'openid' => $openid
        ]);
    }
    public function mylinliajax(Request $request){
        //DB::enableQueryLog();
        $res = null;
        $index = $request -> input('index');
        $fabuindex = $request -> input('fabuindex');
        $where = array();
        if($fabuindex == 1){
            //发布
            if($request -> openid){
                $where['openid'] = $request -> openid;
            }else{
                $where['openid'] = session('openid');
            }

            $where['type'] = $index;

            $res = DB::table('news') -> where($where) -> get();
        }else{
            if($request -> openid){
                $where_huifu['openid'] = $request -> openid;
            }else{
                $where_huifu['openid'] = session('openid');
            }

            //他回复过的
            $pinluns = DB::table('pinlun') -> where($where_huifu) -> get();
            if($pinluns){
                foreach($pinluns as $vo){
                    $ids[] = $vo -> news_id;
                }
            }else{
                $ids = [];
            }



            if(!empty($ids)){
                $res = DB::table('news') -> where([
                    ['type', '=', $index],
                ])->whereIn('id', $ids) -> get();
            }

            //$queries = DB::getQueryLog(); // 获取查询日志

            //dd($queries); // 即可查看执行的sql，传入的参数等等
        }


        if($res){

            //$queries = DB::getQueryLog(); // 获取查询日志

            //dd($queries); // 即可查看执行的sql，传入的参数等等

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
                $res[$k]['created_at'] = date('Y-m-d H:i',$vo['created_at']);

            }
        }


        return response()->json($res);
    }

    public function myorder(){
        return view('home/mycenter/order');
    }

    //喜欢的邻居
    public function likelinju($openid = ''){
        if(!$openid){
            $openid = session('openid');
        }
        $res = DB::table('like_people') -> where([
            'openid' => $openid
        ]) -> get();
        foreach ($res as $k => $vo){
            $res[$k] -> likeuser = DB::table('user') -> where([
                'openid' => $vo -> openid_like
            ]) -> first();
        }

        //dd($res);
        return view('home/mycenter/likelinju') -> with([
            'res' => $res
        ]);
    }

    //喜欢的邻居  取消／选中
    public function likelinjuchange(Request $request){
        $res = DB::table('like_people') -> where([
            'openid' => session('openid'),
            'openid_like' => $request -> input('openid_like'),
        ]) -> first();

        if($res){
            //删除此条
            DB::table('like_people') -> where([
                'openid' => session('openid'),
                'openid_like' => $request -> input('openid_like'),
            ]) -> delete();
        }else{
            //添加
            DB::table('like_people') -> insert([
                'openid' => session('openid'),
                'openid_like' => $request -> input('openid_like'),
            ]);
        }


    }

    //我的收藏
    public function myshoucang(){
        $res = DB::table('shoucang_article') -> where([
            'openid' => session('openid')
        ]) -> get();
        $arr = [];
        foreach($res as $k => $vo){
            $arr[] = $vo -> article_id;
        }
        if($arr){
            $result = DB::table('article') -> whereIn('id',$arr) -> get();
        }else{
            $result = null;
        }

        //dd($result);
        return view('home/mycenter/myshoucang') -> with([
            'res' => $result
        ]);
    }

    //关于我们
    public function aboutus(){
        return view('home/mycenter/aboutus');
    }

    //优惠券
    public function ticket(){
        return view('home/mycenter/ticket');
    }

    public function mydata(){
        $res = DB::table('user') -> where([
            'openid' => session('openid')
        ]) -> first();

        //查找小区名称
        $res -> xiaoquname = DB::table('shequ') -> where([
            'id' => $res -> xiaoqu
        ]) -> first();
        //dd($res);
        return view('home/mycenter/mydata')->with([
            'res' => $res
        ]);
    }

    public function myservice(){
        $bodas = DB::table('boda_service') -> where([
            'openid' => session('openid')
        ]) -> get();
        $ids = array();
        foreach($bodas as $vo){
            $ids[] = $vo -> service_id;
        }

        $res = array();
        if($ids){
            $res = DB::table('service') ->whereIn('id', $ids) -> get();
        }else{
            $res = null;
        }


        return view('home/mycenter/myservice') -> with([
            'res' => $res
        ]);
    }

    //订单ajax
    public function orderlist(Request $request){
        $index = $request -> input('index');
        $res = DB::table('order') -> where([
            'openid' => session('openid'),
            'status' => $index
        ]) -> get();
        foreach($res as $k => $vo){
            $res[$k] -> created_at = date('Y-m-d H:i',$vo -> created_at);
            switch ($vo -> status){
                case 0:$res[$k] -> status_name = '待收货';break;
                case 1:$res[$k] -> status_name = '待评价';break;
                case 2:$res[$k] -> status_name = '已完成';break;
                case 3:$res[$k] -> status_name = '退货';break;
            }

            $res[$k] -> goods_info = DB::table('goods') -> where([
                'id'=> $vo -> goods_id
            ]) -> first();

            if($vo -> peisong_type == 0){
                $res[$k] -> peisong_type = '货物自提';
            }else{
                $res[$k] -> peisong_type = '送货上门';
            }

            $res[$k] -> user_info = DB::table('user') -> where([
                'openid'=> $vo -> openid
            ]) -> first();


        }
        return response() -> json($res);
    }

    public function tuikuan_page($orderid){
        return view('home/mycenter/tuikuan_page') -> with([
            'orderid'=>$orderid
        ]);
    }
    public function tuikuanRes(Request $request){
        $res = DB::table('order') -> where([
            'order_id' => $request -> input('orderid')
        ]) -> update([
            'status' => 3,
            'show_status' => '申请退款',
            'tuikuan_content' => $request -> input('content'),
            'tuikuan_imgs' => $request -> input('img'),
        ]);
        echo 'success';
    }

    //退款
    public function tuikuan(Request $request){

        $res = DB::table('order') -> where([
            'order_id' => $request -> input('orderid')
        ]) -> update([
            'status' => 3,
            'show_status' => '申请退款',
        ]);
        echo 'success';
    }
    //确认收货
    public function querenshouhuo(Request $request){
        $res = DB::table('order') -> where([
            'order_id' => $request -> input('orderid')
        ]) -> update([
            'status' => 1,
            'show_status' => '待评价',
        ]);
        echo 'success';
    }

    //评价
    public function pingjia($orderid){
        return view('home/mycenter/pingjia') -> with([
            'orderid'=>$orderid
        ]);
    }

    public function fabiaopinglun(Request $request){
        $res = DB::table('order') -> where([
            'order_id' => $request -> input('orderid')
        ]) -> update([
            'pinglun' => $request -> input('content'),
            'imgs' => $request -> input('img'),
            'star' => $request -> input('star'),
            'status' => 2,
            'show_status' => '已完成'
        ]);


        if($res){
            echo 'success';
        }else{
            echo 'error';
        }

    }

}
