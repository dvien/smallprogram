<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

define('APPID','wx68099d0c30ed4f39');
define('SECRET','d4624c36b6795d1d99dcf0547af5443d');
class WxModel extends Model
{

    //检查openid在不在user表中，如果不在 则储存
    public function checkOpenid(){
        if(!session('openid')){
            //获取openid
            $this -> getOpenId();
        }
        $isset = DB::table('user') -> where([
            'openid' => session('openid'),

        ]) -> first();

        if(!$isset){
            $userinfo = $this -> getUserInfo();
            session([
                'headimgurl' => $userinfo['headimgurl'],
                'sex' => $userinfo['sex']
            ]);

            //没有 就取让他注册
            return 'redirect_reg';
        }else{
            //'status' => 1  审核成功后状态未1
            session([
                'xiaoqu' => $isset -> xiaoqu,
                'status' => $isset -> status,
            ]);
            return $isset;
        }
    }


    public function getAccessToken() {
        $appId = APPID;
        $appSecret = SECRET;
        $file = file_get_contents(getcwd().'/file/access_token.json');
        $data = json_decode($file,true);
        //如果不存在 data  or time 过期
        if (!$data || time() - $data['time'] > 7000) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appId&secret=$appSecret";
            $res = json_decode(file_get_contents($url),true);
            //dump($res);exit;
            $access_token = $res['access_token'];
            if ($access_token) {
                //$data->expire_time = time();
                //$data->access_token = $access_token;

                $res_str['time'] = time();
                $res_str['token'] = $access_token;

                file_put_contents(getcwd().'/file/access_token.json', json_encode($res_str));

            }
        } else {
            $access_token = $data['token'];
        }
        return $access_token;
    }

    /**
     * 发送模板信息
     *
    //发送模板消息
    $msg['touser'] = S('openid');
    $msg['template_id'] = "2QTaCgyijXvmDQqZSF4lLnJiGL7HaEEpucM5H6sAbXI";
    $msg['url'] = "www.baidu.com";
    $msg['data'] = array(
    'first' =>array(
    'value' => '恭喜你购买成功！',
    'color' => '#173177',
    ),
    'keyword1' => array(
    'value' => '玫瑰花',
    'color' => '#173177',
    ),
    'keyword2'  => array(
    'value' => '2345366546',
    'color' => '#173177',
    ),
    'keyword3' => array(
    'value' => '2017-01-01',
    'color' => '#173177',
    ),
    'remark' => array(
    'value' => '请定期为花卉浇水和施肥，如需提供上门养护服务，请在线下单',
    'color' => '#173177',
    ),
    );
    //dump($msg);exit;
    $result = $model -> send_tempmsg($msg);
     **/
    public function send_tempmsg($data){
        $token = $this -> getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;
        $res = $this -> http_post($url,json_encode($data));
        return json_decode($res,true);
    }


    /**
     * 获取Openid
     * Enter description here ...
     */
    public function getOpenId(){
        //获取到了code ，通过code获取token
        $appId = APPID;
        $appSecret = SECRET;
        $url_token = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appId."&secret=".$appSecret."&code=".$_GET['code']."&grant_type=authorization_code";
        //得到token 和 openid
        $open_token = file_get_contents($url_token);
        $open_token = json_decode($open_token,true);
        //dump($open_token);exit;
        //获取到了openid
        //存储openid
        session([
            'openid' => $open_token['openid']
        ]);

        return $open_token['openid'];
    }

    /**
     * 通过openid获取用户信息
     * Enter description here ...
     */
    public function getUserInfo(){
        $token = $this -> getAccessToken();
        //dump($token);exit;
        $openid = session('openid') ;
        //dump($openid);exit;
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$openid."&lang=zh_CN";
        $userinfo = file_get_contents($url);
        $userinfo = json_decode($userinfo,true);
        //dd($userinfo);
        return $userinfo;
    }



    public function http_get($url) {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * 以post方式提交xml到对应的接口url
     * @param type $url
     * @param type $postdata
     * @return boolean
     */
    public function http_post($url, $postdata) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        if (is_array($postdata)) {
            foreach ($postdata as &$value) {
                if (is_string($value) && stripos($value, '@') === 0 && class_exists('CURLFile', FALSE)) {
                    $value = new CURLFile(realpath(trim($value, '@')));
                }
            }
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $data = curl_exec($ch);
        curl_close($ch);
        if ($data) {
            return $data;
        }
        return false;
    }


}
