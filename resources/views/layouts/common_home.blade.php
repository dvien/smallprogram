<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
    <title>首页</title>
</head>
<body>


    <header class="public-header keys-search" id="header-search" style="display:none;" >

        <div>
            <i class="iconfont icon-search-copy"></i>
            <input type="text" placeholder="请输入服务关键词搜索" id="servicetoptext"/>
        </div>
        <span></span>
    </header>


    <header class="public-header" id="header-fanhui">

        <img src="{{asset('images/logo.png')}}">
    </header>


@include('layouts.common_zhide')

<article class="community-details">

        <div class="flex-justify community-search" id="navigation2" style="display:none;">

            <a class="hover">全部<div><img src="{{asset('images/interaction-up2.png')}}"></div></a>
            <a >公共服务</a>
            <a >家居维修</a>
            <a >家政上门</a>
            <a >家庭生活</a>
        </div>

        <div class="flex-justify community-nav" id="navigation" >
            <a class="hover">邻居说<div><img src="{{asset('images/interaction-up2.png')}}" /></div></a>
            <a >友邻互助</a>
            <a >社区活动</a>
            <a >共享车位</a>
        </div>




    @section('volist')

    @show


</article>
    @if(!isset($usertype) || $usertype != 'visit' )
        <img src="{{asset('images/user-comment.png')}}" class="user-comment" id="user-comment"/>
    @endif
<div class="fixed-height"></div>
    @if(!isset($usertype) || $usertype != 'visit' )
@include('layouts.common_foot')
    @endif
<div class="pop-bg none" @if(!empty($ismark))style="display:block;"@endif>
    <div class="welcome-main">
        <div>
            <img src="{{asset('images/welcome.png')}}" />
            <div>
                <p>您是第<span>@if(!empty($ismark)){{$ismark}}@endif</span>位</p>
                <p>入驻本小区哦</p>
            </div>
        </div>
        <img src="{{asset('images/woman.png')}}" />
        <i class="iconfont icon-icon-test" id="closepop"></i>
    </div>
</div><input type="hidden" id="usertype" value="@if($userinfo){{ $userinfo  -> shenfen}}@endif" />
    <div class="pop-bg none" id="sendwuye">
        <div class="send-info">
            <form>
                <input type="text" placeholder="补充说明，无则空置" name="content" id="fankui_content"/>
                <input type="hidden" name="id" id="fankui_news_id" />
                <p>将本条信息转派给物业？</p>
                <div class="flex-justify"><a id="quxiao">取消</a><a id="quedingwuye">确定</a></div>
            </form>
        </div>
    </div>

<script>
    $(function(){
        $('#closepop').click(function(){
            $('.pop-bg').hide();
        })
        //alert(111);
        var index = 0;
        var page = 0;
        $('#box-index').val(0);
        $('#box-0').val(0);
        $('#box-1').val(0);
        $('#box-2').val(0);
        $('#box-3').val(0);
        var url = '{{url('/home/ajax')}}';

        $.ajax({
            type: 'POST',
            url: url,
            data: {index:index,page:page},
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                if(data.length){
                    var html = getInfo(index,data);

                    $('#content-box .vo-box').eq(index).append(html);

                    $('#box-'+index).val(parseInt(page)+1);
                }else{
                    $('#box-'+index).attr('data',1);
                }


            },
            error: function(xhr, type){
                //alert('Ajax error!')
            }
        });



    })


    //邻里互动的切换
    $('#navigation a').click(function(){


        var index = $(this).index();
        $('#navigation a').removeClass('hover');
        $('#content-box .vo-box').hide();
        $('#box-index').val(index);
        //alert(index)

        $(this).addClass('hover');
        //获取当前选择的页数
        var page = $('#box-'+index).val();

        var url = '{{url('/home/ajax')}}';
        //alert(url);return false;
        if(page == 0){
            $.ajax({
                type: 'POST',
                url: url,
                data: {index:index,page:page},
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data.length){
                        var html = getInfo(index,data);

                        $('#content-box .vo-box').eq(index).append(html);

                        $('#box-'+index).val(parseInt(page)+1);
                    }else{
                        $('#box-'+index).attr('data',1);
                    }


                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });
        }
        $('#content-box .vo-box').eq(index).show();
        //结束滚动的标志
        $('#scroll').val(1);




    })


    //便民服务点击上方搜索
    $('#servicetoptext').blur(function(){
        var url = '{{url('/home/ajax2')}}';
        //alert(url);return false;
        var keywords = $.trim($(this).val());
        //alert(keywords);return false;
        if(keywords){
            $('#content-box2').empty();
            $.ajax({
                type: 'POST',
                url: url,
                data: {index:0,keywords:keywords},
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    var html = getInfo2(data);
                    $('#content-box2').append(html);
                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });
        }




    })

    //便民服务的切换
    $('#navigation2 a').click(function(){


        var index = $(this).index();
        $('#navigation2 a').removeClass('hover');
        $(this).addClass('hover');


        $('#content-box .vo-box').hide();
        $('#box-index2').val(index);


        var url = '{{url('/home/ajax2')}}';
        $('#content-box2').empty();
        //alert(url);return false;

            $.ajax({
                type: 'POST',
                url: url,
                data: {index:index},
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    var html = getInfo2(data);

                    $('#content-box2').append(html);


                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });






    })


    document.onscroll = function(){

        if(document.body.scrollTop+document.body.clientHeight>=document.body.scrollHeight){
            //是否滚动的标志
            var scroll = $('#scroll').val();

            if(scroll == 0 ){
                //获取当前选择的页数
                var index = $('#box-index').val();
                var page = $('#box-'+index).val();
                var url = '{{url('/home/ajax')}}';
                //判断有没有数据  有数据就请求
                if(!$('#box-'+index).attr('data')){
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {index:index,page:page},
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success: function(data){
                            if(data.length){
                                var html = getInfo(index,data);

                                $('#content-box .vo-box').eq(index).append(html);

                                $('#box-'+index).val(parseInt(page)+1);
                            }else{
                                $('#box-'+index).attr('data',1);
                            }



                        },
                        error: function(xhr, type){
                            //alert('Ajax error!')
                        }
                    });
                }
            }else{
                $('#scroll').val(0)
            }



        }
    }


    //点击发布
    $('#user-comment').click(function(){
        var index = $('#box-index').val();
        location.href='{{url('/home/fabu')}}'+'/'+index;
    })


    //获取邻里互动
    function getInfo(index,data){
        var html = '';
        var usertype = $('#usertype').val();
        if(index == 0){
            for(var i=0; i<data.length; i++) {
                var img_list = data[i].img;
                var huifu_list = data[i].wuyehuifu;
                //邻里说
                html += '<section class="comment-title" ';
                @if($usertype == 'person')
                    html += 'onclick="location.href='+"'{{url('home/pinlun/')}}"+'/'+data[i].id+"'"+'" ';
                @else
                    html += 'onclick="noReg()"';
                @endif

                html += ' >';
                html += '<header class="comment-head flex-justify">';
                html += '<h3>'+data[i].title+'<span class="hygiene">'+data[i].label+'</span>';


                if(data[i].huifu){
                    html += '<span class="';
                    if(data[i].status == 1){
                        html  += 'resolved';
                    }else{
                        html += 'pending';
                    }
                    html += '">'+data[i].status_name+'</span>';
                }


                html +='</h3>';
                html += '<span>';

                if(usertype  >= 2 && !data[i].huifu){
                    html += '<i class="iconfont write icon-xieriji" style="z-index:100;" onclick="zhuanpai('+data[i].id+')"></i>';
                }


                html += data[i]['userinfo'].name+'</span>';
                html += '</header>';
                html += '<p>'+data[i].miaoshu+'</p>';

                if(img_list){
                    html += '<div class="comment-img clearfix">';
                    for(var j=0;j<img_list.length;j++){
                        html += '<div style="' + "background:url('{{asset('images/')}}"+'/'+img_list[j]+"') no-repeat center;background-size:cover;" + '"></div>';
                    }
                    html += '</div>';
                }
                img_list = null;


                html += '<footer class="comment-foot flex-justify">';
                html += '<span>'+data[i].created_at+'</span>';
                html += '<div><i class="iconfont icon-good"></i> ';
                html += '<span  onclick="dianzan(this,'+data[i].id+')" >'+data[i].dianzan+'</span>';
                html += '<img src="{{asset('images/comment.png')}}" /> <span>'+data[i].liulan+'</span>';
                html += '</div></footer>';

                if(huifu_list){
                    for(var k=0;k<huifu_list.length;k++){
                        html += '<div class="property-reply">物业回复：'+huifu_list[k].content+'</div>';
                    }
                }

                /*
                if(data[i].wuyehuifu){
                    data[i].wuyehuifu.each(function(j){
                        html += '<div class="property-reply">物业回复：'+j.content+'</div>';
                    })
                }
                */


                html += ' </section>';
            }

        }

        //友邻互助
        if(index == 1){
            for(var i=0; i<data.length; i++) {
                var img_list = data[i].img;
                html += '<section class="comment-title"><header class="comment-head flex-justify">';
                html += '<h3>'+data[i].title+'<strong>';
                if(data[i].price == '0.00'){
                    html += '面议';
                }else{
                    html += '<em>¥ </em>'+data[i].price;
                }

                html += '</strong></h3>';
                html += '<span>'+data[i]['userinfo'].name+'</span></header>';
                html += '<p>'+data[i].miaoshu+'</p>';


                if(img_list){
                    html += '<div class="comment-img clearfix">';
                    for(var j=0;j<img_list.length;j++){
                        html += '<div style="' + "background:url('{{asset('images/')}}"+'/'+img_list[j]+"') no-repeat center;background-size:cover;" + '"></div>';
                    }
                    html += '</div>';
                }



                html += '<footer class="comment-foot flex-justify">';
                html += '<span>'+data[i].created_at+'</span>';
                html += '<div><i class="iconfont icon-good"></i>';
                html += '<span onclick="dianzan(this,'+data[i].id+')" >'+data[i].dianzan+'</span>';
                html += '</div></footer><div class="property-reply flex-justify"><div class="demand-time">';
                html += '<h4>需求时间</h4><p>'+data[i].date+'</p></div>';
                html += '<div class="demand-btn"><a  ';
                if(!data[i].openid_help){
                    html += 'class="hover" onclick="helphim('+data[i].id+')" ';
                }

                html += ' >帮TA</a><a href="tel:+'+ data[i]['userinfo'].tel +'">联系看看</a></div></div></section>';
            }

        }

        //社区活动
        if(index == 2){
            for(var i=0; i<data.length; i++) {
                var img_list = data[i].img;

                html += '<section class="comment-title" ';
                @if($usertype == 'person')
                html += 'onclick="location.href='+"'{{url('home/pinlun/')}}"+'/'+data[i].id+"'"+'"';
                @else
                    html += 'onclick="noReg()"';
                @endif
                html +='>';
                html += '<header class="comment-head flex-justify">';
                html += '<h3>'+data[i].title+'</h3>';
                html += '<span>'+data[i]['userinfo'].name+'</span></header>';
                html += '<p>'+data[i].miaoshu+'</p>';


                if(img_list){
                    html += '<div class="comment-img clearfix">';
                    for(var j=0;j<img_list.length;j++){
                        html += '<div style="' + "background:url('{{asset('images/')}}"+'/'+img_list[j]+"') no-repeat center;background-size:cover;" + '"></div>';
                    }
                    html += '</div>';
                }



                html += '<footer class="comment-foot flex-justify">';
                html += '<span>'+data[i].created_at+'</span>';
                html += '<div><i class="iconfont icon-good"></i>';
                html += '<span>'+data[i].dianzan+'</span><img src="images/comment.png" /><span>'+data[i].liulan+'</span>';
                html += '</div></footer></section>';

            }
        }

        //
        if(index == 3){
            for(var i=0; i<data.length; i++) {
                var img_list = data[i].img;
                html += '<section class="comment-title" ';
                @if($usertype == 'person')
                html += 'onclick="location.href='+"'{{url('home/pinlun/')}}"+'/'+data[i].id+"'"+'"';
                @else
                    html += 'onclick="noReg()"';
                @endif
                html +='>';
                html += '<header class="comment-head flex-justify">';
                html += '<h3>'+data[i].title+'<strong><em>¥ </em>'+data[i].price+'</strong></h3>';
                html += '<span>'+data[i]['userinfo'].name+'</span></header>';
                html += '<div class="comment-time"><span>时间</span> '+data[i].date+' 至 '+data[i].date_right+' </div>';
                html += '<p>'+data[i].miaoshu+'</p>';
                html += '<div class="comment-img clearfix">';

                if(img_list){
                    html += '<div class="comment-img clearfix">';
                    for(var j=0;j<img_list.length;j++){
                        html += '<div style="' + "background:url('{{asset('images/')}}"+'/'+img_list[j]+"') no-repeat center;background-size:cover;" + '"></div>';
                    }
                    html += '</div>';
                }
                html += '</div><footer class="comment-foot flex-justify">';
                html += '<span>'+data[i].created_at+'</span></footer></section>';

            }
        }
        return html;
    }

    //便民服务
    function getInfo2(data){
        var html = '';
        for(var i=0; i<data.length; i++) {
            html += '<div class="flex-justify"><div class="concact-main">';
            html += '<h3>'+data[i].title+'</h3>';
            html += '<div class="concact-icon flex-align"><i class="iconfont icon-good"></i>';
            html += '<span onclick="dianzan2(this,'+data[i].id+')"  >'+data[i].dianzan+'</span><i class="iconfont icon-dianhua1"></i><span>'+data[i].boda+'</span></div></div><a href="tel:+'+ data[i].tel +'" onclick="tel('+data[i].id+')">马上联系</a></div>';


        }

        return html;
    }



</script>
    <script>


        function tel(id){
            layer.msg('正在呼叫');
            //service 呼叫次数加一
            var url = '{{url('home/calltime')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {id:id},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){

                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });
        }
        function helphim(id){
            layer.confirm('确定帮他（她）么', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //确定帮他
                var url = '{{url('home/helphim')}}';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {id:id},

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(data){
                        if(data == 'success'){
                            layer.msg('帮助成功');
                        }else{
                            layer.msg('帮助失败');
                        }
                    },
                    error: function(xhr, type){
                        //alert('Ajax error!')
                    }
                });


            }, function(){

                layer.msg('您已取消', {time:200});


            });
        }

        function dianzan(what,id){
            var url = '{{url('home/newszan')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {news_id:id},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        //$('#dianzan_num').text(parseInt($('#dianzan_num').text() + 1));
                        $(what).text(parseInt($(what).text()) + 1);
                        layer.msg('点赞+1');
                    }else{
                        layer.msg('您已经点过赞了');
                    }
                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });
        }

        function dianzan2(what,id){
            var url = '{{url('home/newszant')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {news_id:id},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        //$('#dianzan_num').text(parseInt($('#dianzan_num').text() + 1));
                        $(what).text(parseInt($(what).text()) + 1);
                        layer.msg('点赞+1');
                    }else{
                        layer.msg('您已经点过赞了');
                    }
                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });
        }

        function zhuanpai(id){
            //alert(id);
            $('#fankui_news_id').val(id);
            $('#sendwuye').show();

        }

        $('#quxiao').click(function(){
            $('#sendwuye').hide();
        })
        //确定提交给物业
        $('#quedingwuye').click(function(){
            var id = $('#fankui_news_id').val();
            var content = $('#fankui_content').val();
            var url = '{{url('/home/fankuiRes')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {id:id,content:content},
                //dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        layer.msg('转交成功');
                        $('#sendwuye').hide();
                        location.reload();
                    }

                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });
        })

        function noReg(){
            layer.msg('您的身份还未审核通过，请耐心等待下');
        }
    </script>
</body>
</html>


