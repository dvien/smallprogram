<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
@include('layouts.common_fanhui')
<section class="comment-title">
    <header class="comment-head flex-justify">
        <h3>{{$res['title']}}@if($res['type'] == 3)<strong><em>¥ </em>{{ $res['price'] }}</strong> <a href="tel:{{ $res['userinfo'] -> tel }}" ><i class="iconfont icon-dianhua"></i></a>@endif @if($res['type'] == 4)<a href="tel:{{ $res['userinfo'] -> tel }}" ><i class="iconfont icon-dianhua"></i></a>@endif </h3>
        <span>{{ $res['userinfo'] -> name }}</span>
    </header>
    @if($res['type'] == 3) <div class="comment-time"><span>时间</span> {{ $res['date'] }} 至 {{ $res['date_right'] }} </div> @endif
    <p>{{$res['miaoshu']}}</p>
    @if(!empty($res['img']))
    <div class="comment-img clearfix">
        @foreach($res['img'] as $vo)
        <div style="background:url('{{asset('images')}}/{{$vo}}') no-repeat center;background-size:cover;"  onclick="showimg('{{asset('images')}}/{{$vo}}') "></div>
        @endforeach
    </div>
    @endif
    <footer class="comment-foot flex-justify">
        <span>{{ date('Y-m-d H:i:s',$res['created_at']) }}</span>
        <div>
            <i class="iconfont icon-good"></i>
            <span id="dianzan_num">{{$res['dianzan']}}</span>
            <img src="{{asset('images/comment.png')}}" />
            <span>{{$res['liulan']}}</span>
        </div>
    </footer>
</section>
@if(!empty(count($res_pinlun)))
<article class="comment-wrap">
    <h3>评论</h3>
    <div class="comment-content">

            @foreach($res_pinlun as $vo)
                <div class="flex comment-list">
                    <div style="background:url('@if(!empty($vo -> userinfo)){{$vo -> userinfo ->img}}@endif') no-repeat center;background-size:cover;" onclick="location.href='{{ url('home/likeman').'/'.$vo -> openid }}'"></div>
                    <div class="flex-1 comment-main">
                        <div class="flex-justify"><span>{{ $vo -> userinfo -> name }}</span><span>{{ date('Y-m-d H:i',$vo -> created_at) }}</span></div>
                        <p>{!! $vo -> content !!}</p>
                    </div>
                </div>
            @endforeach
    </div>
</article>
@endif
<div class="fixed-height"></div>
<div class="text-input-foot">
    <div class="text-input flex-align">
        <i class="iconfont expression icon-xiaolian"></i>
        <input type="text" placeholder="评论: " class="flex-1" id="pinlun">

        <a id="fasong">发送</a>
    </div>
    <div class="replay-operate">
        <div class="faceList">
            <ul class="swiper-wrapper">
                <li class="swiper-slide"></li>
                <li class="swiper-slide"></li>
                <li class="swiper-slide"></li>
            </ul>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <input type="hidden" name="news_id" id="news_id" value="{{ $res['id'] }}" />
</div>

<script>


    /*表情库*/
    $(".expression").click(function(){
        $(".faceList").toggleClass("active");
    })
    var mySwiper = new Swiper('.faceList', {
        pagination : '.swiper-pagination',
    });
    var i;
    for(i=1;i<=18;i++){
        $(".faceList").find("li").eq(0).append('<div data= "' + i+ '" ><img src="{{asset('face')}}'+'/'+i+'.gif"/></div>')
    };
    for(i=19;i<=36;i++){
        $(".faceList").find("li").eq(1).append('<div data= "' + i+ '" ><img src="{{asset('face')}}'+'/'+i+'.gif"/></div>')
    };
    for(i=55;i<=72;i++){
        $(".faceList").find("li").eq(2).append('<div data= "' + i+ '" ><img src="{{asset('face')}}'+'/'+i+'.gif"/></div>')
    };
    $("input,textarea").focus(function(){
        $(".faceList").removeClass("active");
    })

    $('.faceList div ').click(function(){
        //先获取输入框的值
        var value = $("#pinlun").val();
        value += '[em_'+$(this).attr('data')+']';
        $("#pinlun").val(value);
    })

    $(function(){
        $('#fasong').click(function(){

            var content = $('#pinlun').val();
            var newsid = $('#news_id').val();


            if(!$.trim(content)){
                layer.msg('请填写内容');return false;
            }
            var url = '{{url('home/pinlunRes')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {content:content,news_id:newsid},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        layer.msg('发送成功');
                        setTimeout(function(){location.reload()},1000);
                        //location.reload();
                    }
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });

        });

        //点赞
        $('.icon-good').click(function(){
            var newsid = $('#news_id').val();
            var url = '{{url('home/newszan')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {news_id:newsid},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        $('#dianzan_num').text(parseInt($('#dianzan_num').text() + 1));
                        layer.msg('点赞+1');
                    }else{
                        layer.msg('您已经点过赞了');
                    }
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });


        })




    })

    function showimg(url){
        //alert(url);

        $('#top-box img').src = url;
        $('#top-box').show();

    }
    $('#top-box').click(function(){
        $('#top-box').hide();
    })
</script>
</body>
</html>


