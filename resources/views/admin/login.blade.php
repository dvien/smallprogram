<!doctype html>
<html lang="zh-CN">
<head>
    @include('layouts.common_admin')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/login.css')}}">
</head>

<body class="user-select">
<div class="container">
    <div class="siteIcon"><img src="{{asset('admin/images/icon/icon.png')}}" alt="" data-toggle="tooltip" data-placement="top" title="欢迎使用校友录后台管理系统" draggable="false" /></div>
    <form action="{{url('admin/loginRes')}}" method="post" autocomplete="off" class="form-signin">
        <h2 class="form-signin-heading">管理员登录</h2>
        <label for="userName" class="sr-only">用户名</label>
        <input type="text" id="userName" name="username" class="form-control" placeholder="请输入用户名" required autofocus autocomplete="off" maxlength="10">
        <label for="userPwd" class="sr-only">密码</label>
        <input type="password" id="userPwd" name="password" class="form-control" placeholder="请输入密码" required autocomplete="off" maxlength="18">

        <select name="type" class="form-control" style="margin-bottom:10px;display:none;">
            <option value="0">平台管理员</option>
            <option value="1">社区管理员</option>
        </select>

        <a><button class="btn btn-lg btn-primary btn-block" type="submit" id="signinSubmit">登录</button></a>
        {{ csrf_field() }}
    </form>
    <div class="footer" style="display:none;">
        <p><a href="{{url('admin/index')}}" data-toggle="tooltip" data-placement="left" title="不知道自己在哪?">回到后台 →</a></p>
    </div>
</div>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    window.oncontextmenu = function(){
        //return false;
    };
    $('.siteIcon img').click(function(){
        window.location.reload();
    });
    $('#signinSubmit').click(function(){
        if($('#userName').val() === ''){
            $(this).text('用户名不能为空');
        }else if($('#userPwd').val() === ''){
            $(this).text('密码不能为空');
        }else{
            $(this).text('请稍后...');
        }
    });

    @if (session('status'))
        alert('登陆失败！');
    @endif
</script>
</body>
</html>
