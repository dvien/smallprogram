<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<article class="user-center">
    <header class="public-header">
        <img src="{{asset('images/logo.png')}}">
    </header>
    <div class="user-main">
        <div class="user-photo">
            <div style="background:url('{{$res -> img}}') no-repeat center;background-size:cover;"></div>
        </div>
        <h3>{{ $res -> xiaoqu -> title }}</h3>
    </div>
</article>
<article class="clearfix center-nav">
    <a href="{{ url('home/mylinli') }}">
        <img src="{{asset('images/nav1.png')}}" />
        <h4>邻里互助</h4>
    </a>
    <a href="{{ url('home/myservice') }}">
        <img src="{{asset('images/nav2.png')}}" />
        <h4>便民服务</h4>
    </a>
    <a href="{{ url('home/myorder') }}">
        <img src="{{asset('images/nav3.png')}}" />
        <h4>商品订单</h4>
    </a>
    <a href="{{ url('home/likelinju') }}">
        <img src="{{asset('images/nav4.png')}}" />
        <h4>喜欢的邻居</h4>
    </a>
    <a href="">
        <img src="{{asset('images/nav5.png')}}" />
        <h4>系统消息</h4>
    </a>
    <a href="{{ url('home/ticket') }}">
        <img src="{{asset('images/nav6.png')}}" />
        <h4>优惠券</h4>
    </a>
    <a href="{{ url('home/myshoucang') }}">
        <img src="{{asset('images/nav7.png')}}" />
        <h4>我的收藏</h4>
    </a>
    <a href="{{ url('home/mydata') }}">
        <img src="{{asset('images/nav8.png')}}" />
        <h4>个人资料</h4>
    </a>
    <a href="{{ url('home/aboutus') }}">
        <img src="{{asset('images/nav9.png')}}" />
        <h4>更多设置</h4>
    </a>
</article>
@include('layouts.common_foot')
</body>
</html>


