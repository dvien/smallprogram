<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
@include('layouts.common_fanhui')

<img src="{{asset('images/user-comment.png')}}" class="user-comment" id="user-comment"/>
@if(!empty($res))
    @foreach($res as $vo)
        <section class="comment-title" style="border-bottom: 1px solid #efefef;" >
            <header class="comment-head flex-justify" onclick="location.href='{{ url('home/pinlun',['id'=>$vo['id']]) }}'"  >
                <h3>{{ $vo['title'] }}</h3>
                <span>{{ $vo['userinfo'] -> name }}</span>
            </header>
            <p>{{  $vo['miaoshu'] }}</p>

            @if(!empty($vo['img']))
            <div class="comment-img clearfix">
                @foreach($vo['img'] as $vol)
                <div style="background:url('{{asset('images').'/'.$vol}}') no-repeat center;background-size:cover;"></div>
                @endforeach
            </div>
            @endif

            <footer class="comment-foot flex-justify">
                <span>{{ date('Y-m-d H:i',$vo['created_at'] ) }}</span>
                <div>
                    <i class="iconfont icon-good" ></i>
                    <span onclick="dianzan(this,'{{ $vo['id'] }}')">{{ $vo['dianzan'] }}</span>
                    <img src="{{asset('images/comment.png')}}" />
                    <span>{{ $vo['liulan'] }}</span>
                </div>
            </footer>
        </section>
    @endforeach
@endif
<script>
    $(function () {
        //点击发布
        $('#user-comment').click(function(){
            var index = $('#box-index').val();
            location.href='{{url('/home/marketfabu')}}';
        })
    })

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
                    $(what).text(parseInt($(what).text() + 1));
                    layer.msg('点赞+1');
                }else{
                    layer.msg('您已经点过赞了');
                }
            },
            error: function(xhr, type){
                alert('Ajax error!')
            }
        });
    }
</script>
</body>
</html>


