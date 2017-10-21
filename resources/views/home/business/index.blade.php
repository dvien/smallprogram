<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
    <title>商户登陆</title>

</head>
<body>
<style>
    body{background:#efefef;}
    .service-input>div>span{
        width: 1.5rem;
    }
    .superselect a {
        height: 0.56rem;
        background: url('{{ asset('images/right.png') }}') no-repeat 95% center;
        background-size: 0.13rem;
    }
</style>

<header class="public-header">

    <i class="iconfont icon-fanhui" style="display:none;"></i>

    <img src="{{asset('images/logo.png')}}" />
</header>

<article class="vote">
    <header class="flex-justify" id="top-nav">
        <a  class="hover" ><span>我的客户</span></a>
        <a ><span>我发布的服务</span></a>
    </header>

    <article class="customer-main" id="box-0">
        @if(!empty($mycustomer))
            @foreach($mycustomer as $vo)
                <section class="customer-list">
                    <div>
                        <div class="flex-justify">
                            <h3 class="flex-1">{{ $vo -> userinfo -> name  }}</h3>
                            <a href="tel:{{ $vo -> userinfo -> tel }}"><img src="{{ asset('images/tel.png') }}" ></a>
                        </div>
                        <p>{{ date('Y-m-d H:i',$vo -> created_at) }}</p>
                    </div>
                </section>
            @endforeach
        @endif
    </article>

    <article class="customer-main" id="box-1" style="display:none;">
        @if(!empty($newarr))
            @foreach($newarr as  $k => $vo)
                <div class="service-area">
                    <h3>服务名称<span>{{ $titlearr[$k]['title'] }}</span></h3>
                    <h4>服务小区</h4>
                    <div class="area-main">
                        @foreach($vo as $vol)
                        <div class="flex-justify">
                            <div class="area-time">{{ $vol -> xiaoquinfo -> title }}<span>到期时间：{{ date('Y-m-d H:i',$vol -> created_at+86400*360) }}</span></div>
                            <a>续费</a>
                        </div>
                        @endforeach

                    </div>
                    <p>联系电话：{{ $titlearr[$k]['tel'] }}</p>
                </div>
            @endforeach
        @endif
        <footer class="publish-service">
            <a id="fabufuwu">+ 发布服务</a>
        </footer>
    </article>

    <article class="customer-main" id="box-2" style="display:none;">
        <div class="service-input">
            <div class="flex-align" style="margin-top:0.2rem;">
                <span>服务名称</span>
                <input type="text" placeholder="请输入服务名称" class="flex-1" id="servicename"/>
            </div>
            <div class="flex-align service-select" style="margin-top:0.2rem;">
                <div>选择服务小区</div>
                <a id="selectxiaoqu" class="flex-1"></a>
            </div>

            <div class="service-txt" style="display:none;" id="xiaoqu-bbox">
                <div id="xiaoqu-box">


                </div>
            </div>
            <div class="flex-align superselect" style="position:relative;margin-top:0.2rem;" >
                <span>服务类别</span>
                <select name="type" style="font-size: 15px;width:100px;" id="type">
                    <option value="0">公共服务</option>
                    <option value="1">家居维修</option>
                    <option value="2">家政上门</option>
                    <option value="3">家庭生活</option>
                </select>
                <a id="" class="flex-1"></a>
            </div>
            <div class="flex-align" style="margin-top:0.2rem;">
                <span>联系电话</span>
                <input type="text" placeholder="请输入电话" id="tel" class="flex-1"/>
            </div>
            <div class="flex-align" style="margin-top:0.2rem;">
                <span>费用</span>
                <input type="text" placeholder=""  value="180元/小区/年" class="flex-1"/>
            </div>
        </div>
        <footer class="apply flex-align">
            <div class="flex-1">共需支付 <span id="paynumber">180</span> 元</div>
            <a id="pay">去支付</a>
        </footer>
    </article>

    <article class="customer-main" id="box-3" style="display:none;">
        <div>
            @if(!empty($select_res))
                @foreach($select_res as $vo)
                    <div class="area-search-list flex-align"><input type="checkbox"  value="{{ $vo -> id }}" data='{{ $vo -> title }}' ids="{{ $vo -> id }}" class="xiaoqus" name="xiaoqus"/><i class="iconfont"></i><span>{{ $vo -> title }}</span></div>
                @endforeach
            @endif
        </div>
        <a id="save" class="area-preservation">保存</a>
    </article>

</article>
<input type="hidden" id="ids"  />
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

        $('#fabufuwu').click(function(){
            $('#box-1').hide();
            $('#box-2').show();
            //$('.icon-fanhui').show();
        })

        $('#box-2 #selectxiaoqu').click(function(){
            $('#box-2').hide();
            $('#box-3').show();
            //隐藏返回按钮

        })

        //保存选中的服务
        $('#box-3 #save').click(function(){
            $('#xiaoqu-box').empty();
            var ids = '';
            var number = 0;
            $("input[name=xiaoqus]:checked").each(function(){
                $('#xiaoqu-box').append('<span>'+$(this).attr('data')+'</span>');
                ids += $(this).attr('ids')+',';
                number ++;
            });

            $('#ids').val(ids.substr(0,ids.length));
            number = 180 + (number - 1)*180;
            $('#paynumber').text(number);
            $('#box-2').show();
            $('#box-3').hide();

            $('#xiaoqu-bbox').show();
        })

        $('#pay').click(function(){

             var url = '{{ url('home/business/fabuRes') }}';
             var servicename = $('#servicename').val();
             var ids = $('#ids').val();
             var tel = $('#tel').val();
             var type = $('#type').val();
             $.ajax({
             type: 'POST',
             url: url,
             data: {servicename:servicename,ids:ids,tel:tel,type:type},

             headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             },
             success: function(data){
                if(data == 'success'){
                    //发布的服务支付成功
                    layer.msg('支付成功');
                    setInterval ("zhifuchenggong()", 1000);
                }
             },
             error: function(xhr, type){
             //alert('Ajax error!')
             }
             });


        })

    })

    function zhifuchenggong(){
        //支付成功跳转
        location.reload();
    }
</script>
</html>


