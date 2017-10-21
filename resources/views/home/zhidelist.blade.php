<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<style>
    body{background:#efefef;}
</style>
@include('layouts.common_fanhui')
<article class="vote">
    <header class="flex-justify">
        <a  class="hover" id="zhide"><span>值得看</span></a>
        <a id="toupiao"><span>投票</span></a>
    </header>
    <article class="vote-main" id="article1">
        @if(!empty($list_article))
            @foreach($list_article as $vo)
                <section class="vote-list flex-justify" onclick="location.href='{{url('/home/zhidedetail/'.$vo->id)}}' ">
                    <div class="flex-1">
                        <h3><span>{{$vo -> title}}</span>@if($vo -> ishot == 1)<img src="{{asset('images/hot.png')}}" />@endif</h3>
                        <p>{{date('Y-m-d H:i',$vo->created_at)}}</p>
                    </div>
                    <a href=""></a>
                </section>
            @endforeach
        @endif
    </article>

    <article class="vote-main" id="article2" style="display:none;">
        @if(!empty($list_toupiao))
            @foreach($list_toupiao as $vo)
                <section class="vote-list flex-justify" onclick="location.href='{{ url('home/toupiaodetail',['id'=>$vo -> id]) }}' " >
                    <div class="flex-1">
                        <h3><span>{{$vo -> title}}</span>@if($vo -> ishot == 1)<img src="{{asset('images/hot.png')}}" />@endif</h3>
                        <p>{{date('Y-m-d H:i',$vo->created_at)}}</p>
                    </div>
                    <a href=""><img src="{{asset('images/see.png')}}"></a>
                </section>
            @endforeach
        @endif
    </article>

    <div class="load-more none">
        <p>正在努力加载</p>
        <img src="{{asset('images/more.png')}}" />
    </div>
</article>
<script>
    $(function(){
        var win = $(window).height();
        $(window).scroll(function(){
            var dom =$(document).height();
            var scroll = $(window).scrollTop();
            if(dom-win-scroll<=0){
                $(".load-more").show();
                /*$.ajax({
                 type:post,
                 success:function(data){
                 if(data){
                 $(".load-more").show();
                 }else{
                 $(".load-more").text("加载完毕");
                 }
                 }
                 })*/
            }
        })

        $('#toupiao').click(function(){
            $('#zhide').removeClass('hover');
            $('#toupiao').addClass('hover');
            $('#article1').hide();
            $('#article2').show();
        })

        $('#zhide').click(function(){
            $('#toupiao').removeClass('hover');
            $('#zhide').addClass('hover');
            $('#article2').hide();
            $('#article1').show();
        })
    });
</script>
</body>
</html>


