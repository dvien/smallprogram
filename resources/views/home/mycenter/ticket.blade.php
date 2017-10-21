<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<header class="public-header">
    <i class="iconfont icon-fanhui" onclick="history.go(-1)"></i>
    <img src="{{asset('images/logo.png')}}">
</header>
<article class="vote">
    <header class="flex-justify" id="topnav">
        <a href="javascript:;" class="hover"><span>已领取</span></a>
        <a href="javascript:;"><span>待领取</span></a>
    </header>
    <article class="coupon-main" id="box-1">
        <section class="flex">
            <div class="coupon-time">
                <h3><i>¥</i><span> 5</span></h3>
                <h4>有效期至</h4>
                <p>2017-08-28</p>
            </div>
            <div class="coupon-content flex-1">
                <h3>忆香云5元折扣券</h3>
                <p>请在“忆香云”APP下单时使用</p>
                <p>验证码：65425897</p>
            </div>
        </section>

    </article>
    <article class="coupon-main" id="box-2" style="display:none;">
        <section class="flex">
            <div class="coupon-time">
                <h3><i>¥</i><span> 5</span></h3>
                <h4>有效期至</h4>
                <p>2017-08-28</p>
            </div>
            <div class="coupon-content flex-1">
                <h3>忆香云5元折扣券</h3>
                <p>请在“忆香云”APP下单时使用</p>
                <p>验证码：65425897</p>
                <div><a href="javascript:;">立即领取</a></div>
            </div>
        </section>

    </article>

</article>

</body>
<script>
    $(function(){
        $('#topnav a').click(function(){
            var index = $(this).index()+1;
            $('#topnav a').removeClass('hover');
            $(this).addClass('hover');
            $('.coupon-main').hide();
            $('#box-'+index).show();

        })
    })
</script>
</html>


