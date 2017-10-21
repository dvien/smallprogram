<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no, email=no">
    <meta name="keywords" content="关键字" >
    <meta name="description" content="描述" >

    <script src="{{asset('js/script.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/swiper.3.2.0.min.css')}}">
    <link href="{{asset('css/iconfont.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- 公共生成html js -->
    <meta name="_token" content="{{ csrf_token() }}"/>
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('layer/2.2/layer.js')}}"></script>

</head>
<body>

<header class="public-header">
    <i class="iconfont icon-fanhui" onclick="history.go(-1)"></i>
    <img src="{{asset('images/logo.png')}}">
</header>
<div class="flex-justify goods-wrap">
    <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
    <div class="flex-1 goods-data">
        <h3>{{$res -> title}}</h3>
        <div class="flex-justify">
            <span><i>¥</i> {{ $res -> price_no }} </span>
            <span>× {{$number}}</span>
        </div>
    </div>
</div>
<div class="delivery-mode">
    <h3>配送方式</h3>
    <div class="flex-justify layout pick-goods">
        <span>货物自提</span>
        <div class="pick-radio">
            <input checked type="radio" name="get-type"/>
            <i class="iconfont"></i>
        </div>
    </div>
    <div class="since hide">
        <div class="flex-justify layout">
            <span>选择城区</span>
            <select>
                <option>吴中区</option>
            </select>
        </div>
        <div class="flex-justify layout">
            <span>选择小区</span>
            <select>
                <option>海悦花园</option>
            </select>
        </div>
        <div class="flex-justify layout">
            <span>海悦花园七区2栋102室 18256565566</span>
        </div>
    </div>
    <div class="flex-justify pick-goods layout">
        <span>送货上门</span>
        <div class="pick-radio">
            <input type="radio" name="get-type"/>
            <i class="iconfont"></i>
        </div>
    </div>
    <div class="door hide none">
        <div class="door-tips">
            <div class="flex-align"><i class="iconfont icon-gantanhao"></i>非江浙沪地区暂不邮寄，敬请谅解</div>
        </div>
        <div class="flex-align layout">
            <span>收货人姓名</span>
            <input type="text" placeholder="请输入姓名" class="flex-1"/>
        </div>
        <div class="flex-align layout">
            <span>手机号码</span>
            <input type="tel" placeholder="请输入手机号码" class="flex-1"/>
        </div>
        <div class="flex-align layout area">
            <span>省、市、区</span>
            <input type="text"  id="city-picker" class="flex-1" value="江苏"/>
        </div>
        <div class="flex door-textarea">
            <span>详细地址</span>
            <textarea placeholder="请输入详细地址" class="flex-1"></textarea>
        </div>
    </div>
</div>
<div class="flex-align pay-type">
    <span>支付方式</span>
    <span>微信支付</span>
</div>
<div class="remarks">
    <h3>备注说明</h3>
    <textarea placeholder="可输入100字以内的特殊要求内容" name="remark" id="remark"></textarea>
</div>
<div class="fixed-height"></div>
<footer class="apply flex-align">
    <div class="flex-1 total">合计  <span><i>¥</i> {{ $res -> price_no*$number }}</span></div>
    <a id="pay">确认支付</a>
</footer>
<script>

    $(".pick-radio").click(function(){
        $(this).parents(".pick-goods").next().show().siblings(".hide").hide();
    });


    $(function(){
        $('#pay').click(function(){
            var url = '{{url('/home/payAjax')}}';
            var number = '{{$number}}';
            var id = '{{ $res -> id }}';
            var remark = $('#remark').val();
            $.ajax({
                type: 'POST',
                url: url,
                data: {number:number,id:id,remark:remark},
                //dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    //alert(data);
                    if(data == 'success'){
                        layer.msg('支付成功');
                        setInterval ("tiaozhuan()", 1000);
                    }
                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });
        })
    })

    function tiaozhuan(){
        location.href='{{ url('home/mall') }}';
    }
</script>
</body>
</html>


