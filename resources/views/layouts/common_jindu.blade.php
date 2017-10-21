<article class="vote vote1">
    <header class="flex-justify">
        <a href="{{url('/home/jindu/all')}}" class="{{Request::getPathInfo() == '/home/jindu/all'?'hover':''}}"><span>全部</span></a>
        <a href="{{url('/home/jindu/dai')}}" class="{{Request::getPathInfo() == '/home/jindu/dai'?'hover':''}}"><span>待解决</span></a>
        <a href="{{url('/home/jindu/yi')}}" class="{{Request::getPathInfo() == '/home/jindu/yi'?'hover':''}}"><span>已解决</span></a>
    </header>
</article>