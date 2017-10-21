<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<header class="public-header">
    <!--
    <i class="iconfont icon-fanhui" onclick="location.href='{{ url('home') }}' "></i>
    -->
    <img src="{{asset('images/logo.png')}}">
</header>
@include('layouts.common_jindu')
<article class="community-details">
    @if(!empty($res))
        @foreach($res as $vo)

            <section class="comment-title" onclick="location.href='{{ url('home/pinlun',['id'=>$vo['id']]) }}'" >
                <header class="comment-head flex-justify">
                    <h3>{{ $vo['title'] }}@if(!empty($vo['label']))<span class="hygiene">{{ $vo['label'] }}</span>@endif<span @if($vo['status'] == 0)class="pending"@else class="resolved"@endif >@if($vo['status'] == 0)待解决@else已解决@endif</span></h3>
                    <span>{{ $vo['userinfo'] -> name }}</span>
                </header>
                <p>{{ $vo['miaoshu'] }}</p>
                @if(!empty($vo['img']))
                    <div class="comment-img clearfix">
                        @foreach($vo['img'] as $vol)
                            <div style="background:url('{{asset('images').'/'.$vol}}') no-repeat center;background-size:cover;"></div>
                        @endforeach
                    </div>
                @endif
                <footer class="comment-foot flex-justify">
                    <span>{{ date('Y-m-d H:i',$vo['created_at'] ) }}</span>
                    <div>
                        <i class="iconfont icon-good"></i>
                        <span>{{ $vo['dianzan'] }}</span>
                        <img src="{{asset('images/comment.png')}}" />
                        <span>{{ $vo['liulan'] }}</span>
                    </div>
                </footer>
                @if(!empty($vo['huifu']))
                <div class="property-reply">物业回复：{{$vo['huifu']}}</div>
                @endif
            </section>

        @endforeach
    @endif
</article>
<div class="fixed-height"></div>
@include('layouts.common_foot')
</body>
</html>


