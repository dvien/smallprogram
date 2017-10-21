<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<header class="public-header">
    <img src="{{asset('images/logo.png')}}">
</header>
<article class="vote vote-shop">
    <header class="flex-justify" id="top-fenlei">
        <a class="hover"><span>全部</span></a>
        @if(!empty($res_fenlei))
            @foreach($res_fenlei as $vo)
                <a><span>{{ $vo -> name }}</span></a>
            @endforeach
        @endif
    </header>
    <div class="swiper-container shop-banner">
        <div class="swiper-wrapper">
            @foreach($res_lunbo as $vo)
            <div class="swiper-slide" style="background:url('{{asset('uploads/').'/'.$vo->img}}') no-repeat center;background-size:cover;"></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <div id="vo-box1" class="hidebox">
    @if(!empty($res))
        @foreach($res as $vo)
            <div class="shop-goods">
                <div class="shop-img" onclick="location.href='{{ url('home/malldetail').'/'.$vo -> id }}'" style="background:url('{{asset('uploads/').'/'.$vo->img}}') no-repeat center;background-size:cover;"></div>
                <h3>{{ $vo -> title }}</h3>
                <div class="flex-align shop-data">
                    <div class="flex-1"><i>¥</i> {{ $vo -> price_no }} <span>¥ {{ $vo -> price_pre }}</span></div>
                    <span>已售 {{$vo -> number}}</span>
                    <a href="{{ url('home/malldetail').'/'.$vo -> id }}">立即购买</a>
                </div>
            </div>
        @endforeach
    @endif
    </div>


        @foreach($res_fenlei as $key => $value)
            <div id="vo-box{{ intval($key)+2 }}" style="display:none;" class="hidebox" >
            @if(!empty($res))
                @foreach($res as $vo)
                    @if($vo -> type == $value -> id)
                    <div class="shop-goods">
                        <div class="shop-img" onclick="location.href='{{ url('home/malldetail').'/'.$vo -> id }}'" style="background:url('{{asset('uploads/').'/'.$vo->img}}') no-repeat center;background-size:cover;"></div>
                        <h3>{{ $vo -> title }}</h3>
                        <div class="flex-align shop-data">
                            <div class="flex-1"><i>¥</i> {{ $vo -> price_no }} <span>¥ {{ $vo -> price_pre }}</span></div>
                            <span>已售 {{$vo -> number}}</span>
                            <a href="{{ url('home/malldetail').'/'.$vo -> id }}">立即购买</a>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif
            </div>
        @endforeach


</article>
<div class="fixed-height"></div>

<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/fastclick-min.js')}}"></script>
<script src="{{asset('js/swiper.3.2.0.jquery.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script>
    var mySwiper = new Swiper ('.swiper-container', {
        loop: true,
        pagination: '.swiper-pagination',
        autoplayDisableOnInteraction : false,
    })
</script>
<script>
    $(function(){
        $('#top-fenlei a').click(function(){
            $('#top-fenlei a').removeClass('hover');
            $(this).addClass('hover');
            var index = $(this).index()+1;
            $('.vote-shop .hidebox').hide();
            $('#vo-box'+index).show();
        })
    })
</script>
</body>
</html>


