<header style="height:50px;">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">切换导航</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" >校友录</a> </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ session('username') }} </a>
                    </li>
                    <li><a href="{{url('admin/loginout')}}" onClick="if(!confirm('是否确认退出？'))return false;">退出登录</a></li>
                </ul>
                <!--
                <form action="" method="post" class="navbar-form navbar-right" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" placeholder="键入关键字搜索" maxlength="15" name="keywords" @if(!empty($keywords)) value="{{ $keywords }}" @endif )>

                        {{ csrf_field() }}
                        <span class="input-group-btn">
              <button class="btn btn-default" type="submit">搜索</button>
              <button class="btn btn-default" type="button" onclick="location.href='{{Request::getRequestUri()}}' ">重置</button>
              </span> </div>
                </form>
                -->
            </div>
        </div>
    </nav>
</header>