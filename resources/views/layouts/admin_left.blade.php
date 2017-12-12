<aside class="col-sm-1 col-md-1 col-lg-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><a></a></li>
    </ul>
    <style>
        .dropdown-menu-new {
            width:100%;

            display: none;

            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            font-size: 14px;
            text-align: left;
            list-style: none;
            background-color: #fff;

            background-clip: padding-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .dropdown-menu-new>li>a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }
        .show{
            display:block;
        }

    </style>
    <script>
        $(function(){
            $('.dropdown-toggle-d').click(function(){
                if($(this).parent().find('.dropdown-menu-new').hasClass('show')){
                    $(this).parent().find('.dropdown-menu-new').removeClass('show');

                }else{
                    $('.dropdown-menu-new').removeClass('show');
                    $(this).parent().find('.dropdown-menu-new').addClass('show');

                }

            })
        })
    </script>
    <ul class="nav nav-sidebar">
        <li @if(Route::currentRouteName() == 'setting' )class="active" @endif ><a class="dropdown-toggle-d" id="number"   >参数管理</a>
            <ul class="dropdown-menu-new @if(Route::currentRouteName() == 'setting' ) show @endif "  >

                <li><a href="{{url('admin/setting/0')}}">专业信息</a></li>
                <li><a href="{{url('admin/setting/1')}}">行业（职业）信息</a></li>
                <li><a href="{{url('admin/setting/2')}}">爱好标签</a></li>
                <li><a href="{{url('admin/setting/3')}}">邀请码管理</a></li>
            </ul>
        </li>
        <li @if(Route::currentRouteName() == 'school' )class="active" @endif ><a href="{{ url('admin/school') }}"   >学校管理</a>
        </li>
        <li @if(Route::currentRouteName() == 'xiaoweihui' )class="active" @endif ><a href="{{ url('admin/xiaoweihui') }}"   >校友会管理</a>
        </li>
        <li @if(Route::currentRouteName() == 'user' )class="active" @endif ><a href="{{ url('admin/user') }}"   >用户管理</a>
        </li>
        <li @if(Route::currentRouteName() == 'activity' )class="active" @endif ><a href="{{ url('admin/activity') }}"   >活动管理</a>
        </li>



    </ul>


    <!--
    <ul class="nav nav-sidebar">
        <li><a href="category.html">栏目</a></li>
        <li><a class="dropdown-toggle-d" id="otherMenu"   >其他</a>
            <ul class="dropdown-menu-new" >
                <li><a href="flink.html">友情链接</a></li>
                <li><a data-toggle="modal" data-target="#areDeveloping">访问记录</a></li>
            </ul>
        </li>
    </ul>
    <ul class="nav nav-sidebar">
        <li><a class="dropdown-toggle-d" id="userMenu"   >用户</a>
            <ul class="dropdown-menu-new" aria-labelledby="userMenu">
                <li><a data-toggle="modal" data-target="#areDeveloping">管理用户组</a></li>
                <li><a href="manage-user.html">管理用户</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="loginlog.html">管理登录日志</a></li>
            </ul>
        </li>
        <li><a class="dropdown-toggle-d" id="settingMenu"   >设置</a>
            <ul class="dropdown-menu-new" aria-labelledby="settingMenu">
                <li><a href="setting.html">基本设置</a></li>
                <li><a href="readset.html">阅读设置</a></li>
                <li role="separator" class="divider"></li>
                <li><a data-toggle="modal" data-target="#areDeveloping">安全配置</a></li>
                <li role="separator" class="divider"></li>
                <li class="disabled"><a>扩展菜单</a></li>
            </ul>
        </li>
    </ul>
    -->

</aside>