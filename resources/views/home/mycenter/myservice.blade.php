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
    <article class="reservation">
        <h3>历史预约</h3>
        <div class="reservation-main">
            @if(!empty($res))
                @foreach($res as $vo)
            <div>
                <h4>{{ $vo -> title }}</h4>
                <p>{{ date('Y-m-d',$vo -> created_at) }}</p>
            </div>
                @endforeach
            @endif
        </div>
    </article>
</body>
</html>


