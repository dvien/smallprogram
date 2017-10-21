<footer class="foot-nav flex-justify">
    <a href="{{url('/home')}}"class="{{Request::getPathInfo()=='/home'?'hover':''}}" >
        <i class="iconfont icon-shouye"></i>
        <h4>首页</h4>
    </a>
    <a href="{{url('/home/jindu/all')}}" class="{{(Request::getPathInfo()=='/home/jindu/all' or Request::getPathInfo()=='/home/jindu/yi' or Request::getPathInfo()=='/home/jindu/dai')  ?'hover':''}}">
        <i class="iconfont icon-jindu"></i>
        <h4>进度</h4>
    </a>
    <a href="{{url('/home/mycenter')}}" class="{{Request::getPathInfo()=='/home/mycenter'?'hover':''}}" >
        <i class="iconfont icon-wode-copy"></i>
        <h4>我的</h4>
    </a>
</footer>