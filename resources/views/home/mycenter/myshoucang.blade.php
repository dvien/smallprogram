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
    <article class="vote-main">
        @if(!empty($res))
            @foreach($res as $vo)
                <section class="vote-list flex-justify" onclick="location.href='{{url('/home/zhidedetail/'.$vo->id)}}' " >
                    <div class="flex-1">
                        <h3><span>{{ $vo -> title }}</span><!--<img src="{{asset('images/hot.png')}}" />--> </h3>
                        <p>{{ date('Y-m-d',$vo -> created_at) }}</p>
                    </div>
                    <!--
                    <a><img src="{{ asset('mages/see.png') }}"></a>
                    -->
                </section>
            @endforeach
        @endif

    </article>

</article>

</body>
<script>

</script>
</html>


