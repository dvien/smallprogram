
    <div class="keys-banner" style="display:none;">
        <img src="{{asset('images/keys-banner.jpg')}}" />
    </div>

    <div class="worth-see">
        <h3 class="flex-justify">
            <span><img src="{{asset('images/eye.png')}}"/> 今日值得看</span>
            <a href="{{url('/home/zhidelist')}}">更多>></a>
        </h3>
        <div class="worth-main">
            @if(!empty($list_toupiao))
                @foreach($list_toupiao as $vo)
                    <div class="worth-list flex-justify" onclick="location.href='{{ url('home/toupiaodetail',['id'=>$vo -> id]) }}' ">
                        <span>{{$vo -> title}}@if($vo -> ishot == 1)<img src="{{asset('images/hot.png')}}" />@endif</span>
                        <img src="{{asset('images/worth-see.png')}}" />
                    </div>
                @endforeach
            @endif

            @if(!empty($list_article))
                @foreach($list_article as $vo)
                    <div class="worth-list flex-justify" onclick="location.href='{{url('home/zhidedetail')}}/{{$vo -> id}}'" >
                        <span>{{$vo -> title}}@if($vo -> ishot == 1)<img src="{{asset('images/hot.png')}}" />@endif</span>
                    </div>
                @endforeach
            @endif

        </div>
    </div>




<div class="flex-justify service-list" id="topnav">
    <div>
        <a id="linlihudong" class="hover">
            <img src="{{asset('images/interaction-icon.png')}}" />
            <h4>邻里互动</h4>
            <div id="up1-img"><img src="{{asset('images/interaction-up1.jpg')}}" /></div>
        </a>
    </div>
    <div>
        <a id="bianminfuwu" >
            <img src="{{asset('images/convenience.png')}}" />
            <h4>便民服务</h4>
            <div id="up2-img" style="display:none;"><img src="{{asset('images/interaction-up1.jpg')}}" /></div>
        </a>
    </div>
    <div>
        <a id="hangjiazaixian" href="{{url('home/hangjia')}}" >
            <img src="{{asset('images/online.png')}}" />
            <h4>行家在线</h4>
        </a>
    </div>
    <div>
        <a id="fangxinban" >
            <img src="{{asset('images/rest.png')}}" />
            <h4>放心班</h4>
        </a>
    </div>
</div>
<script>
    $(function(){
        $('#bianminfuwu').click(function(){

            //将发布标签隐藏掉
            $('#user-comment').hide();

            $('#content-box').hide();
            $('#content-box2').show();

            $('#header-fanhui').hide();
            $('#header-search').show();

            $('.worth-see').hide();
            $('.keys-banner').show();

            $('#navigation').hide();
            $('#navigation2').show();

            $('#topnav a').removeClass('hover');
            $(this).addClass('hover');

            $('#up1-img').hide();
            $('#up2-img').show();

            //请求
            var index = 0;
            var url = '{{url('/home/ajax2')}}';
            $('#box-index2').val(0);
            $('#content-box2').empty();
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
                    alert('Ajax error!')
                }
            });

            //滚动翻页标志变为1
            $('#scroll').val(1);
        })

        $('#linlihudong').click(function(){
            //将发布标签显示
            $('#user-comment').show();

            $('#content-box').show();
            $('#content-box2').hide();

            $('#header-fanhui').show();
            $('#header-search').hide();

            $('.worth-see').show();
            $('.keys-banner').hide();

            $('#navigation2').hide();
            $('#navigation').show();

            $('#topnav a').removeClass('hover');
            $(this).addClass('hover');


            $('#up2-img').hide();
            $('#up1-img').show();
            $('#scroll').val(0);


        })
    })
</script>