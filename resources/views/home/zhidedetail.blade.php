<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
<style>
    body{background:#fff;}

</style>
@include('layouts.common_fanhui')
<article class="article-page">
    <h3>{{$data -> title}}</h3>
    <div class="article-time">{{date('Y-m-d H:i',$data->created_at)}}</div>
    <div class="article-main">
        {!! $data -> content !!}
    </div>
</article>
<div class="interaction" style="padding-bottom:20px;">
    <i class="iconfont icon-heart  "  ></i>
    <i class="iconfont icon-good @if(!$data -> zan){{ 'nocolor' }}@endif "  ></i>
</div>

</body>
<script>
    $(function(){
        @if(!$data -> shoucang)
            $('.icon-heart').css('color','#000000');
        @endif
        @if(!$data -> zan)
            $('.icon-good').css('color','#000000');
        @endif

        //点收藏
        $('.icon-heart').click(function(){


            var id = '{{ $data -> id }}';
            var url = '{{url('home/articleshoucang')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {id:id},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        $('.icon-heart').css('color','');
                    }else{
                        $('.icon-heart').css('color','#000000');
                    }
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });
        })

        //点赞
        $('.icon-good').click(function(){


            var id = '{{ $data -> id }}';
            var url = '{{url('home/articlezan')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {id:id},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        $('.icon-good').css('color','');
                    }else{
                        $('.icon-good').css('color','#000000');
                    }
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });
        })


    })
</script>
</html>


