<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
    <title>商户登陆</title>

</head>
<body>
<style>
    body{background:#fff;}
    .service-input>div {
        height: 0.88rem;
        margin-top: 0.2rem;
        padding: 0 0 0 0.25rem;
        background: #fff;
    }
</style>

<header class="public-header">

    <i class="iconfont icon-fanhui" style="display:none;"></i>

    <img src="{{asset('images/logo.png')}}" />
</header>

<article class="vote">
    <header class="flex-justify" id="top-nav">
        <a   ><span>我的客户</span></a>
        <a class="hover"><span>我发布的服务</span></a>
    </header>

    <div class="service-input">
        <div class="flex-align" >
            <span>服务名称</span>
            <input type="text" placeholder="请输入服务名称" class="flex-1" id="servicename" />
        </div>
        <div class="flex-align service-select">
            <div>选择服务小区</div>
            <a href="{{ url('home/business/selectxiaoqu') }}" class="flex-1"></a>
        </div>

        <div class="service-txt" @if(empty($newarr))style="display:none;"@endif>
            <div>
                @if(!empty($newarr))
                    @foreach($newarr as $vo)
                        <span>{{ $vo -> title }}</span>

                    @endforeach
                        <input type="hidden" id="ids" value="{{ explode(',',$newarr) }}" />
                @endif
            </div>
        </div>
        <div class="data-select">
            <select class="identity" name="type">
                <option value="0">公共服务</option>
                <option value="1">家居维修</option>
                <option value="2">家政上门</option>
                <option value="3">家庭生活</option>
            </select>
        </div>


        <div class="flex-align">
            <span>联系电话</span>
            <input type="text" placeholder="请输入电话" id="tel" class="flex-1"/>
        </div>
        <div class="flex-align">
            <span>费用</span>
            <input type="text" placeholder="" value="180元/小区/年" class="flex-1"/>
        </div>
    </div>
    <footer class="apply flex-align">
        <div class="flex-1">共需支付 <span>180</span> 元</div>
        <a id="pay">去支付</a>
    </footer>

</article>

</body>
<script>
    $(function(){
        $('#top-nav a').click(function(){
            var index = $(this).index();
            $('#top-nav a').removeClass('hover');
            $(this).addClass('hover');
            $('.customer-main').hide();
            $('#box-'+index).show();
        })

        $('#pay').click(function(){
            /*
            var url = '{{ url('home/business/fabuRes') }}';
            var servicename = $('#servicename').val();
            var ids = $('#ids').val();
            var tel = $('#tel').val();
            $.ajax({
                type: 'POST',
                url: url,
                data: {servicename:servicename,ids:ids,tel:tel},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){

                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });
            */

        })
    })
</script>
</html>


