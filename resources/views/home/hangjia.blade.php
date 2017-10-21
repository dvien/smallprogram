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
<article class="expert">
    @unless(!$res)
        @foreach($res as $vo)
            <section class="flex-justify">
                <div style="background:url('{{asset('uploads').'/'.$vo['img']}}') no-repeat center;background-size:cover;"></div>
                <div class="expert-main flex-1">
                    <h3 class="flex-align">{{$vo['title']}}@if($vo['is_mark'] == 0)<span>邻里格</span>@endif</h3>
                    <div>
                        {{$vo['name']}}<span>{{$vo['tel']}}</span>
                    </div>
                    <p>{{$vo['content']}}</p>
                </div>
            </section>
        @endforeach
    @endunless
</article>

</body>
</html>


