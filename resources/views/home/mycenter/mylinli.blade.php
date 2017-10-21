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
<article class="vote vote2">
    <header class="flex-justify" id="navigation">
        <a href="javascript:;" class="hover"><span>邻居说</span></a>
        <a href="javascript:;"><span>友邻互助</span></a>
        <a href="javascript:;"><span>社区活动</span></a>
        <a href="javascript:;"><span>共享车位</span></a>
        <a href="javascript:;"><span>跳蚤市场</span></a>
    </header>
</article>
<article class="community-details">
    <div class="release">
        <img src="{{asset('images/interaction-up2.png')}}" style="left:8%;" id="leftimg"/>
        <a  class="hover">发布</a>
        <a >回复</a>
    </div>
    <!-- 内容 -->
    <div id="content-box">

    </div>
    <!-- 邻里说 友邻互助 社区活动 的切换 -->
    <input type="hidden" name="index" id="index" />
    <!-- 发布回复的切换 -->
    <input type="hidden" name="fabuindex" id="fabuindex" value="1"/>
    <input type="hidden" name="openid" id="openid" value="{{ $openid }}" />
</article>

</body>
<script>
    $(function(){
        var index = 0;
        $('#index').val(index);
        var url = '{{url('/home/mylinliajax')}}';
        $('#content-box').empty();
        var fabuindex = $('#fabuindex').val();
        var openid = $('#openid').val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {index:index,fabuindex:fabuindex,openid:openid},
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                if(data.length){
                    var html = getInfo(index,data);

                    $('#content-box').append(html);
                }else{
                    $('#box-'+index).attr('data',1);
                }


            },
            error: function(xhr, type){
                alert('Ajax error!')
            }
        });

        //切换
        $('#navigation a').click(function(){
            var fabuindex = $('#fabuindex').val();
            var openid = $('#openid').val();
            var index = $(this).index();
            $('#index').val(index);
            var left = 8 + index*20;
            $('#leftimg').css('left',left+'%');
            $('#navigation a').removeClass('hover');
            $(this).addClass('hover');
            var url = '{{url('/home/mylinliajax')}}';
            $('#content-box').empty();
            //切换时复位发布回复
            $('.release a').removeClass('hover');
            $('.release a').eq(0).addClass('hover');
            $('#fabuindex').val(1);
            $.ajax({
                type: 'POST',
                url: url,
                data: {index:index,fabuindex:fabuindex,openid:openid},
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data.length){
                        var html = getInfo(index,data);
                        $('#content-box').append(html);
                    }
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });

        });

        //发布 | 回复的切换
        $('.release a').click(function(){
            var openid = $('#openid').val();
            var fabu = $('#fabuindex').val();
            var fabuindex = 0;
            if(fabu == 1){
                fabuindex = 2;
                $('#fabuindex').val(2);
            }else{
                fabuindex = 1;
                $('#fabuindex').val(1);
            }

            var index = $('#index').val();
            $('.release a').removeClass('hover');
            $(this).addClass('hover');
            var url = '{{url('/home/mylinliajax')}}';
            $('#content-box').empty();
            $.ajax({
                type: 'POST',
                url: url,
                data: {index:index,fabuindex:fabuindex,openid:openid},
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data.length){
                        var html = getInfo(index,data);
                        $('#content-box').append(html);
                    }
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });

        });

    })

    //获取邻里互动
    function getInfo(index,data){
        var html = '';
        if(index == 0){
            for(var i=0; i<data.length; i++) {
                var img_list = data[i].img;
                //邻里说
                html += '<section class="comment-title" >';
                html += '<header class="comment-head flex-justify" onclick="location.href='+"'{{url('home/pinlun/')}}"+'/'+data[i].id+"'"+'" >';
                html += '<h3>'+data[i].title+'<span class="hygiene">'+data[i].label+'</span><span class="pending">'+data[i].status+'</span></h3>';
                html += '<span>'+data[i]['userinfo'].name+'</span>';
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
                html += '<div><i class="iconfont icon-good"></i>';
                html += '<span  onclick="dianzan(this,'+data[i].id+')" >'+data[i].dianzan+'</span>';
                html += '<img src="{{asset('images/comment.png')}}" /><span>'+data[i].liulan+'</span>';
                html += '</div></footer>';
                if(data[i].huifu){
                    html += '<div class="property-reply">物业回复：'+data[i].huifu+'</div>';
                }


                html += ' </section>';
            }

        }

        //友邻互助
        if(index == 1){
            for(var i=0; i<data.length; i++) {
                var img_list = data[i].img;
                html += '<section class="comment-title"><header class="comment-head flex-justify">';
                html += '<h3>'+data[i].title+'<strong><em>¥ </em>'+data[i].price+'</strong></h3>';
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
                html += '<span onclick="dianzan(this,'+data[i].id+')" >'+data[i].dianzan+'</span><img src="{{asset('images/comment.png')}}" /><span>'+data[i].liulan+'</span>';
                html += '</div></footer><div class="property-reply flex-justify">';

                if(!data[i].openid_help){
                    <!-- 如果是没有人帮忙begin -->
                    html += '<div class="demand-time">';
                    html += '<h4>需求时间</h4><p>'+data[i].date+'</p></div>';
                    html += '<div class="demand-btn"><a  ';
                    if(!data[i].openid_help){
                        html += 'class="hover" onclick="helphim('+data[i].id+')" ';
                    }
                    html += ' >帮TA</a><a href="tel:+'+ data[i]['userinfo'].tel +'">联系看看</a></div>';
                    <!-- 如果是没有人帮忙end -->
                }


                if(data[i].openid_help){
                    <!-- 如果是有人帮忙begin -->
                    html += '<div class="demand-time neighbor">';
                    html += '<h4>需求时间 <span>'+data[i].date+'</span></h4><p>好邻居：任泰兴<span>(已接任务)<span></p></div>';
                    html += '<div class="demand-btn"><a  ';
                    if(!data[i].openid_help){
                        html += 'class="hover" onclick="helphim('+data[i].id+')" ';
                    }
                    html += ' >帮TA</a><a href="tel:+'+ data[i]['userinfo'].tel +'">联系看看</a></div>';
                    <!-- 如果是有人帮忙end -->
                }


                html += '</div></section>';
            }

        }

        //社区活动
        if(index == 2){
            for(var i=0; i<data.length; i++) {
                var img_list = data[i].img;

                html += '<section class="comment-title" onclick="location.href='+"'{{url('home/pinlun/')}}"+'/'+data[i].id+"'"+'">';
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
                html += '<section class="comment-title" onclick="location.href='+"'{{url('home/pinlun/')}}"+'/'+data[i].id+"'"+'">';
                html += '<header class="comment-head flex-justify">';
                html += '<h3>'+data[i].title+'<strong><em>¥ </em>'+data[i].price+'</strong><i class="iconfont icon-dianhua"></i></h3>';
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
</script>
</html>


