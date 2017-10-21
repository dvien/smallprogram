<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<header class="public-header">
    <i class="iconfont icon-fanhui"></i>
    <img src="{{asset('images/logo.png')}}">
</header>
@include('layouts.common_jindu')
<article class="community-details">
    <section class="comment-title">
        <header class="comment-head flex-justify">
            <h3>42寸TCL液晶电视折旧出售<span class="hygiene">环境卫生</span><span class="resolved">已解决</span></h3>
            <span>徐晴霞</span>
        </header>
        <p>七区北面20幢西面的儿童游乐区，有一个很大的沙坑，沙坑深，沙子是白色的碎石子一样的，沙坑里面还有很多大石头，非常脏。</p>
        <div class="comment-img clearfix">
            <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
            <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
            <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
        </div>
        <footer class="comment-foot flex-justify">
            <span>2017-06-03 13:42</span>
            <div>
                <i class="iconfont icon-good"></i>
                <span>1764</span>
                <img src="{{asset('images/comment.png')}}" />
                <span>1764</span>
            </div>
        </footer>
    </section>
    <section class="comment-title">
        <header class="comment-head flex-justify">
            <h3>42寸TCL液晶电视折旧出售<span class="hygiene">环境卫生</span><span class="resolved">已解决</span></h3>
            <span>徐晴霞</span>
        </header>
        <p>七区北面20幢西面的儿童游乐区，有一个很大的沙坑，沙坑深，沙子是白色的碎石子一样的，沙坑里面还有很多大石头，非常脏。</p>
        <div class="comment-img clearfix">
            <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
            <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
            <div style="background:url('{{asset('images/comment-img.jpg')}}') no-repeat center;background-size:cover;"></div>
        </div>
        <footer class="comment-foot flex-justify">
            <span>2017-06-03 13:42</span>
            <div>
                <i class="iconfont icon-good"></i>
                <span>1764</span>
                <img src="{{asset('images/comment.png')}}" />
                <span>1764</span>
            </div>
        </footer>
    </section>
    <section class="comment-title">
        <header class="comment-head flex-justify">
            <h3>42寸TCL液晶电视折旧出售<span class="hygiene">环境卫生</span><span class="resolved">已解决</span></h3>
            <span>徐晴霞</span>
        </header>
        <p>七区北面20幢西面的儿童游乐区，有一个很大的沙坑，沙坑深，沙子是白色的碎石子一样的，沙坑里面还有很多大石头，非常脏。</p>
        <footer class="comment-foot flex-justify">
            <span>2017-06-03 13:42</span>
            <div>
                <i class="iconfont icon-good"></i>
                <span>1764</span>
                <img src="{{asset('images/comment.png')}}" />
                <span>1764</span>
            </div>
        </footer>
    </section>
</article>
<img src="{{asset('images/user-comment.png')}}" class="user-comment" />
<div class="fixed-height"></div>
@include('layouts.common_foot')
</body>
</html>


