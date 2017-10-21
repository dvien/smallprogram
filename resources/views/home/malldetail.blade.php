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
<div class="swiper-container send-banner">
    <div class="swiper-wrapper">
        @foreach($res -> imgs as $vo)
        <div class="swiper-slide" style="background:url('{{ asset('uploads').'/'.$vo }}') no-repeat center;background-size:cover;"></div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
<div class="send-goods">
    <h3>{{ $res -> title }}</h3>
    <div class="flex-justify">
        <div class="send-goods-data"><i>¥</i> {{ $res -> price_no }} <span>¥ {{ $res -> price_pre }}</span></div>
        <div class="send-goods-price"><span>库存 {{ $res -> kucun }}</span> <span>已售{{ $res -> number }}</span></div>
    </div>
</div>
<div class="baby-description">
    <nav class="flex-align" id="navigation">
        <a id="top1" class="hover">宝贝详情</a>
        <a id="top2">宝贝评价</a>
        <a id="top3">已购的邻居</a>
    </nav>
    <div class="baby-details" style="padding-bottom:10px;" id="box1">
        {!! $res -> content !!}
    </div>
    <div class="baby-details" id="box2" style="display:none;">
        <div class="flex baby-evaluation">
            <div style="background:url('{{ asset('images/user-photo.jpg') }}') no-repeat center"></div>
            <div class="flex-1">
                <div class="star-num flex-justify">
                    <div class="flex">
                        <span>青团小丸子</span>
                        <div class="evaluation-star">
                            <img src="{{asset('images/stars.png')}}" class="e-stars"/>
                            <img src="{{asset('images/stars.png')}}" class="e-stars"/>
                            <img src="{{asset('images/stars.png')}}" class="e-stars"/>
                            <img src="{{asset('images/no-stars.png')}}"/>
                            <img src="{{asset('images/no-stars.png')}}"/>
                        </div>
                    </div>
                    <span>2017-07-12  12:40</span>
                </div>
                <h3>第一次在社区里面买东西，还真的挺不错的，方便又实惠</h3>
                <div class="evaluation-img clearfix">
                    <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
                    <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
                    <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="baby-details" style="display:none;">
        <div class="purchase-user">
            <ul class="clearfix">
                <li>
                    <div style="background:url('{{asset('images/expert-man.jpg')}}') no-repeat center;background-size:cover;"></div>
                    <h4>业主麦兜</h4>
                </li>

            </ul>
        </div>
    </div>


</div>

<div class="fixed-height"></div>
<footer class="flex-align buy">
    <div class="flex-1">
        <div class="flex-align">
            <i class="iconfont icon-jian"></i>
            <span class="buy-num">1</span>
            <i class="iconfont icon-jia"></i>

            @if(!empty($res -> xiangou))<span>限购{{ $res -> xiangou }}个</span><input type="hidden" id="xiangou" value="{{ $res -> xiangou }}" />@endif
        </div>
    </div>
    <a id="buynow" >立即购买</a>
</footer>

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
        $('#navigation a').click(function(){
            var index = $(this).index();
            $('#navigation a').removeClass('hover');
            $(this).addClass('hover');
            $('.baby-details').hide();
            $('.baby-details').eq(index).show();
        })
        $('.icon-jian').click(function(){
            if(parseInt($('.buy-num').text()) > 1){
                //执行减操作
                $('.buy-num').text(parseInt($('.buy-num').text()) - 1);
            }
        })
        $('.icon-jia').click(function(){
            if($('#xiangou').val()){
                if(parseInt($('.buy-num').text()) < parseInt($('#xiangou').val())){
                    //执行加操作
                    $('.buy-num').text(parseInt($('.buy-num').text()) + 1);
                }
            }else{
                $('.buy-num').text(parseInt($('.buy-num').text()) + 1);
            }

        })

        //立即购买
        $('#buynow').click(function(){
            location.href='{{ url('home/buynow',['id'=>$res -> id])}}'+'/'+$('.buy-num').text();
        })

    });

</script>
</body>
</html>


