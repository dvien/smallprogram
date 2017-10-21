<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
    <style>
        body{background:#fff;}
    </style>
</head>
<body>

<header class="public-header">
    <i class="iconfont icon-fanhui" onclick="history.go(-1)"></i>
    <img src="{{ asset('images/logo.png') }}" />
</header>
<article class="article-page">
    <h3>关于我们</h3>
    <div class="article-time">20160419  08:55</div>
    <div class="article-main">
        <p>内容概要内容概要内容概要内容概要内容内内容概要内容概要
            内容概要内容概要内容概要内容。</p>
        <img src="{{asset('images/article-img.jpg')}}" />
        <p>内容概要内容概要内容概要内容概要内容内内容概要内容概要
            内容概要内容概要内容概要内容。内容概要内容概要内容概要内容概要内容内内容概要内容概要
            内容概要内容概要内容概要内容。内容概要内容概要内容概要内容概要内容内内容概要内容概要
            内容概要内容概要内容概要内容。</p>
    </div>
</article>

<!--
<div class="interaction">
    <i class="iconfont icon-heart"></i>
    <i class="iconfont icon-good"></i>
</div>
-->
</body>
<script>

</script>
</html>


