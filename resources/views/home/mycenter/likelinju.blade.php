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
<article class="love">
    <ul class="clearfix">
        @if(!empty($res))
            @foreach($res as $vo)
                <li>
                    <input type="checkbox" class="love-check" data="{{ $vo -> openid_like }}" checked/>
                    <div class="love-icon"></div>
                    <div class="love-bg" style="background:url('{{$vo -> likeuser -> img}}') no-repeat center;background-size:cover;">
                    </div>
                    <h4>{{ $vo -> likeuser -> name }}</h4>
                </li>
            @endforeach
        @endif

    </ul>
</article>

</body>
<script>
    $(function(){
        $('.love-check').change(function(){
            var url = '{{ url('home/likelinjuchange') }}';
            var openid_like = $(this).attr('data');
            $.ajax({
                type: 'POST',
                url: url,
                data: {openid_like:openid_like},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        layer.msg('发送成功');
                        setTimeout(function(){location.reload()},1000);
                        //location.reload();
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


