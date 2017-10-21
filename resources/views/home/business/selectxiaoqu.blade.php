<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
    <title>商户登陆</title>

</head>
<body>
<style>
    body{background:#fff;}
</style>

<header class="public-header">

    <i class="iconfont icon-fanhui" style="display:none;"></i>

    <img src="{{asset('images/logo.png')}}" />
</header>

<div class="search">
    <div class="search-main">
        <label for="key"><i class="iconfont icon-search-copy"></i></label>
        <input type="text" id="key" placeholder="小区名关键词查找"/>
    </div>
    <a href="">搜索</a>
</div>
<article class="area-search">
    <div>
        @if(!empty($res))
            @foreach($res as $vo)
                <div class="area-search-list flex-align"><input type="checkbox"  value="{{ $vo -> id }}" class="xiaoqus" name="xiaoqus"/><i class="iconfont"></i><span>{{ $vo -> title }}</span></div>
            @endforeach
        @endif
    </div>
    <a id="save" class="area-preservation">保存</a>
</article>

</body>
<script>
    $(function(){
        $('#save').click(function(){
            var str = '';
            $("input[name=xiaoqus]:checked").each(function(){
                str += $(this).val()+",";
            });
            str = str.substr(0,str.length - 1);

            location.href='{{ url('home/business/fabufuwu') }}/'+str;
        })
    })
</script>
</html>


