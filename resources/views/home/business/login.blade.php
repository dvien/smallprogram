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
<div class="register-pop none">
    <i class="iconfont icon-cancel"></i>
    <div>
        <img src="{{asset('images/popularity.png')}}" />
        <a href="">看看人气小区</a>
    </div>
</div>

<header class="public-header">

    <i class="iconfont icon-fanhui" style="display:none;"></i>

    <img src="{{asset('images/logo.png')}}" />
</header>



<form id="myForm"  style="height:100%;">
    <article class="register-data" style="height:100%;">

        <input type="tel" name="username" class="phone" id="username" placeholder="请输入用户名"/>
        <input type="password" name="password" class="verification-code" placeholder="请输入密码" id="password"/>

        <a  class="submit">登录</a>
    </article>
</form>

<script>

    $(".submit").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();

        if(username == ''){
            layer.msg('请输入用户名');
            return false;
        }
        if(password == ''){
            layer.msg('请输入密码');
            return false;
        }



        var url = '{{ url('home/businessLoginRes') }}';
        var data = $('#myForm').serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                if(data == 'success'){
                    location.href='{{ url('home/business/index') }}';
                }else{
                    layer.msg('登陆失败');
                }
            },
            error: function(xhr, type){
                layer.msg('登陆失败');
            }
        });



    });

    $('#find').click(function(){
        $('.icon-fanhui').show();
        $('#myForm').hide();
        $('#search-box').show();
    })

    $('.icon-fanhui').click(function(){
        $('.icon-fanhui').hide();
        $('#myForm').show();
        $('#search-box').hide();
    })

    $('.xiaoqu_name').click(function(){
        var text = $(this).text();
        $('input[name=xiaoqu]').val(text);
        $('.icon-fanhui').hide();
        $('#myForm').show();
        $('#search-box').hide();
    })



</script>
</body>
</html>


