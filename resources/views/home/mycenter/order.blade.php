<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<header class="public-header">
    <i class="iconfont icon-fanhui" onclick="history.go(-1)"></i>
    <img src="{{asset('images/logo.png')}}">
</header>
<nav class="process flex-justify" id="top-nav">
    <a href="javascript:;" class="hover">
        <i class="iconfont icon-daishouhuo"></i>
        <span>待收货</span>
    </a>
    <a href="javascript:;">
        <i class="iconfont icon-daipingjia"></i>
        <span>待评价</span>
    </a>
    <a href="javascript:;">
        <i class="iconfont icon-yiwancheng"></i>
        <span>已完成</span>
    </a>
    <a href="javascript:;">
        <i class="iconfont icon-tuikuan"></i>
        <span>退货/退款</span>
    </a>
</nav>

<article class="process-main"  style="display:none;" id="nogoods">
    <img src="{{asset('images/no-order.png')}}"  />
    <a href="{{ url('home/mall') }}">去商城逛逛</a>
</article>
<article class="process-main" id="content">
    <!--
    <section class="process-list">
        <h3 class="flex-justify">
            <div>订单号：20170710110 <span>2017-07-06  20:30:06</span></div>
            <span>待发货</span>
        </h3>
        <div class="details-main">
            <div class="process-details flex-align">
                <div style="background:url('{{ asset('images/goods.jpg') }}') no-repeat center;background-size:cover;"></div>
                <div class="goods-details flex-1">
                    <h4>32英寸液晶高清 wifi网络 超薄平板电.</h4>
                    <div class="flex-justify">
                        <span><i>¥</i> 1999</span>
                        <span>× 1</span>
                    </div>
                </div>
            </div>
            <div class="flex pick-up"><span>货物自提</span><div class="flex-1">海悦花园七区2栋102室 18256565566</div></div>
            <div class="goods-total flex-justify">
                <div>合计  <span><i>¥</i>1999</span></div>
                <a href="">申请退款</a>
            </div>
        </div>
    </section>
    -->


</article>

</body>
<script>
    $(function(){
        getInfo(0);
        $('#top-nav a').click(function(){
            var index = $(this).index();
            $('#top-nav a').removeClass('hover');
            $(this).addClass('hover');
            getInfo(index);
        })

    })

    function getInfo(index){
        var url = '{{url('home/orderlist')}}';
        $.ajax({
            type: 'POST',
            url: url,
            data: {index:index},
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                if(data.length > 0){
                    var html = '';
                    data.map(function(i){
                        html += '<section class="process-list">';
                        html += '<h3 class="flex-justify">';
                        html += '<div>订单号：'+i.order_id+' <span>'+i.created_at+'</span></div>';
                        html += '<span>'+i.show_status+'</span>';
                        html += '</h3>';
                        html += '<div class="details-main">';
                        html += '<div class="process-details flex-align">';
                        html += '<div style="background:url('+'{{ asset('uploads/') }}'+'/'+i.goods_info.img+') no-repeat center;background-size:cover;"></div>';
                        html += '<div class="goods-details flex-1">';
                        html += '<h4>'+i.goods_info.title+'</h4>';
                        html += '<div class="flex-justify">';
                        html += '<span><i>¥</i> '+i.goods_info.price_no+'</span>';
                        html += '<span>× '+i.number+'</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="flex pick-up"><span>'+i.peisong_type+'</span><div class="flex-1">'+i.address+' '+i.user_info.tel+'</div></div>';
                        html += '<div class="goods-total flex-justify">';
                        html += '<div>合计  <span><i>¥</i>'+i.goods_info.price_no+'</span></div>';
                        if(i.status == 0){
                            html += '<div class="evaluate"><a onclick="tuikuan('+i.order_id+')" >申请退款</a><a onclick="querenshouhuo('+i.order_id+')">确认收货</a></div>';
                        }
                        if(i.status == 1){
                            html += '<div class="evaluate"><a onclick="tuikuan('+i.order_id+')">退货退款</a><a onclick="pingjia('+i.order_id+')" >评 价</a></div>';
                        }
                        if(i.status == 2){
                            html += '<a onclick="tuikuan('+i.order_id+')" >退货退款</a>';
                        }
                        if(i.status == 3){
                            html += '<a>待审核</a>';
                        }

                        html += '</div>';
                        html += '</div>';
                        html += '</section>';
                    });
                    $('#content').empty();
                    $('#content').append(html);
                    $('#nogoods').hide();
                    $('#content').show();
                }else{
                    $('#nogoods').show();
                    $('#content').hide();
                }
            },
            error: function(xhr, type){
                alert('Ajax error!')
            }
        });



    }

    //申请退款
    function tuikuan(orderid){
        var url = '{{ url('home/myorder/tuikuan_page') }}'+'/'+orderid;
        location.href=url;
        /*
        var url = '{{ url('home/myorder/tuikuan') }}';
        //alert(url);return false;
        $.ajax({
            type: 'POST',
            url: url,
            data: {orderid:orderid},
            //dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                if(data == 'success'){
                    layer.msg('申请退款成功');
                    setInterval ("tiaozhuan()", 1000);
                }

            },
            error: function(xhr, type){
                //alert('Ajax error!')
            }
        });
        */
    }

    function querenshouhuo(orderid){
        var url = '{{ url('home/myorder/querenshouhuo') }}';
        //alert(url);return false;
        $.ajax({
            type: 'POST',
            url: url,
            data: {orderid:orderid},
            //dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                if(data == 'success'){
                    layer.msg('确认收货成功');
                    setInterval ("tiaozhuan()", 1000);
                }

            },
            error: function(xhr, type){
                //alert('Ajax error!')
            }
        });
    }

    //评价
    function pingjia(orderid){
        var url ='{{ url('home/myorder/pingjia') }}'+'/'+orderid;
        //alert(url);return false;
        location.href=url;
    }

    function tiaozhuan(){
        location.reload();
    }
</script>
</html>


