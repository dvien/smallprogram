<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
    <title>注册</title>

</head>
<body>
<style>
    body{background:#fff;}
</style>
<div class="register-pop" style="z-index:100;" >
    <i class="iconfont icon-cancel"></i>
    <div>
        <img src="{{asset('images/popularity.png')}}" />
        <a href="{{ url('home/look') }}">看看人气小区</a>
    </div>
</div>

<header class="public-header">

    <i class="iconfont icon-fanhui" style="display:none;"></i>

    <img src="{{asset('images/logo.png')}}" />
</header>

<article class="search-page none" id="search-box" style="top:43px;">
    <div class="search">
        <div class="search-main">
            <label for="key"><i class="iconfont icon-search-copy"></i></label>
            <input type="text" id="keywords" placeholder="小区名关键词查找" style="width:70%;"/>
        </div>
        <a id="search-button">搜索</a>
    </div>
    <div class="key-list">
        @foreach($xiaoqu as $vo)
            <a class="xiaoqu_name" onclick="searchXiaoquName('{{ $vo -> title }}','{{ $vo->id }}')" data="{{ $vo -> id }}">{{ $vo -> title }}</a>
        @endforeach
    </div>
</article>

<form id="myForm">
    <article class="register-data">
        <input type="text" name="name" class="name" placeholder="请输入真实姓名"/>
        <input type="tel" name="tel" class="phone" placeholder="请输入手机号"/>
        <div class="code">
            <input type="text" class="verification-code" placeholder="请输入验证码"/>
            <input type="button" name="code"  class="get-code" value="获取验证码"/>
        </div>
        <div class="code">
            <input type="text"  name="xiaoqu" class="key-search" placeholder="小区名关键词查找" disabled/>
            <a id="find"><i class="iconfont icon-search-copy"></i>查找</a>
        </div>
        <input type="hidden" name="xiaoquname" id="xiaoquname" />
        <div class="data-select">

            <select class="floor" name="louhao" id="louhao">
                <option value="">请选择</option>
            </select>
        </div>
        <div class="data-select"><input type="text" class="house-number"  name="menpaihao" placeholder="请输入门牌号如1单元402室" /></div>
        <div class="data-select">
            <select class="identity" name="shenfen">
                <option value="0">产权人</option>
                <option value="1">居民</option>
            </select>
        </div>
        <div class="data-select data-select-last">
            <select class="status" name="jiating">
                <option value="">家庭状态</option>
                <option value="1">单身青年</option>
                <option value="2">二人世界</option>
                <option value="3">三口之家</option>
                <option value="4">一家四口</option>
                <option value="5">五福临门</option>
                <option value="6">更多</option>
            </select>
        </div>
        <div class="agreement">
            <input type="checkbox" id="checkbox" name="checkcheck" checked value="yes" style="width:14px;"/>
            <span></span>
            <a onclick="showXieyi()">邻里格用户协议</a>
        </div>
        <a href="javascript:;" class="submit">申请注册</a>
    </article>
</form>

<script>
    $(".get-code").click(function(){
        var num = 60;
        function reduce(){
            if(num==0){
                $(".get-code").removeAttr("disabled");
                $(".get-code").val("重新发送");
                num = 60;
                clearInterval(time);
                return false;
            }else{
                $(".get-code").prop("disabled", true);
                $(".get-code").val(num+"秒");
                num--;
            }
        }
        var time = setInterval(reduce,1000);
    });
    $(".submit").click(function(){
        var name = $(".name").val();
        var phone = $(".phone").val();
        var code = $(".verification-code").val();
        var floor = $(".floor").val();
        var house_number = $(".house-number").val();
        var identity = $(".identity").val();
        var status = $(".status").val();
        var check = $('input[name=checkcheck]:checked').val();
        ///alert(check);
        if(name == ''){
            layer.msg('请输入真实姓名');
            return false;
        }
        if(phone == ''){
            layer.msg('请输入手机号');
            return false;
        }
        var reg = /^1[3578]\d{9}$/;
        if (!reg.test(phone)) {
            layer.msg('请输入正确手机号');
            return false;
        }
        if(code == ''){
            layer.msg('请获取验证码');
            return false;
        }

        if(floor == ''){
            layer.msg('请选择楼号');
            return false;
        }
        if(house_number == ''){
            layer.msg('请输入门牌号');
            return false;
        }
        if(identity == ''){
            layer.msg('请输入身份');
            return false;
        }
        if(status == ''){
            layer.msg('请选择家庭状态');
            return false;
        }
        if(!check){
            layer.msg('请同意邻里格用户协议');
            return false;
        }



        var url = '{{ url('home/regRes') }}';
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
                    //询问框
                    layer.confirm('您已成功提交注册信息，请等待审核<br>您可浏览小区', {
                        btn: ['立即前往','暂不查看'] //按钮
                    }, function(){
                        location.href='{{ url('/home') }}';
                    }, function(){
                        layer.msg('ok');
                    });
                }
            },
            error: function(xhr, type){
                layer.msg('Ajax error!')
            }
        });




    });

    //ajax 搜索
    $('#search-button').click(function(){
        //获取搜索框的值
        var url = '{{ url('home/regSearch') }}';
        var keywords = $.trim($('#keywords').val());
        $.ajax({
            type: 'POST',
            url: url,
            data: {keywords:keywords},
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                var html = '';
                if(data.length > 0){
                    for(var i=0; i<data.length; i++) {
                        html += '<a class="xiaoqu_name" onclick="searchXiaoquName('+"'" +data[i].title+"'"+','+data[i].id+')" data="'+data[i].id+'">'+ data[i].title +'</a>';
                    }
                }
                $('.key-list').empty();
                $('.key-list').append(html);


            },
            error: function(xhr, type){
                layer.msg('Ajax error!')
            }
        });
    })


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

    /*
    $('.xiaoqu_name').click(function(){
        var text = $(this).text();
        $('input[name=xiaoqu]').val(text);
        $('#xiaoquname').val($(this).attr('data'));
        $('.icon-fanhui').hide();
        $('#myForm').show();
        $('#search-box').hide();
    })
    */

    function searchXiaoquName(text,id){
        $('input[name=xiaoqu]').val(text);
        $('#xiaoquname').val(id);
        $('.icon-fanhui').hide();
        $('#myForm').show();
        $('#search-box').hide();

        //把小区传到后台 把小区所属楼栋号
        var url = '{{ url('home/getLoudongFromXiaoqu') }}';
        $.ajax({
            type: 'POST',
            url: url,
            data: {id:id},
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                var html = '';
                var number = data.number_lou;
                for(var i = 1;i<= number;i++){
                    html += '<option value="'+i+'">'+i+'号楼</option>';
                }
                $('#louhao').empty();
                $('#louhao').append(html);


            },
            error: function(xhr, type){
                layer.msg('Ajax error!')
            }
        });
    }


    @if ($ischeck)
            $('.register-data').hide();
            $('.register-pop').hide();
            layer.msg('提交成功，后台审核中!');

    @endif

    $('.icon-cancel').click(function(){
        $('.register-pop').hide();
    })

    function showXieyi(){
        layer.open({
            type: 2,
            title: '用户协议',
            shadeClose: true,
            shade: 0.8,
            area: ['100%', '100%'],
            content: "{{ url('home/xieyi') }}" //iframe的url
        });
    }

</script>
</body>
</html>


