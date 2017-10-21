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
<article class="sale evaluate">
    <form id="myForm">
        <div class="sale-text">
            <h3>评价</h3>
            <textarea placeholder="请对该商品做出评价" id="content"></textarea>

            <div class="sale-upload clearfix">
                <a id="mark"></a>
                <div class="upload-file" id="uploadfile" ><input type="file" name="file" /></div>
            </div>

        </div>
        <div class="score">
            <h3>请给该商品评分</h3>
            <div>
                <img src="{{ asset('images/stars.png') }}" class="star"/>
                <img src="{{ asset('images/stars.png') }}" class="star"/>
                <img src="{{ asset('images/stars.png') }}" class="star"/>
                <img src="{{ asset('images/no-stars.png') }}" />
                <img src="{{ asset('images/no-stars.png') }}" />
            </div>
        </div>
        <a class="publish">发表</a>

        <!-- 存放图片路径 -->
        <input type="hidden" id="imgsrc" name="imgsrc" value="" />
        <!-- 计数 -->
        <input type="hidden" id="count" value="0" />
    </form>
</article>

<script>
    $(function(){
        //发表
        $('.publish').click(function(){
            var orderid = '{{ $orderid }}';
            var content = $('#content').val();
            var img = $('#imgsrc').val();
            var star = $('.star').length;

            var url = '{{ url('home/myorder/fabiaopinglun') }}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {content:content,img:img,star:star,orderid:orderid},
                //dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        layer.msg('评价成功');
                        setInterval ("tiaozhuanorder()", 1000);
                    }

                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });
        })

        $(".upload-file").change(function(){
            var formData = new FormData(document.getElementById("myForm"));
            var url = '{{url('home/saveImg')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                dataType:'json',
                // 告诉jQuery不要去处理发送的数据
                processData : false,
                // 告诉jQuery不要去设置Content-Type请求头
                contentType : false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    var img = '{{asset('images')}}'+'/'+data.img;
                    //alert(img);
                    var length = $(".sale-upload>div").length;
                    var html = '<div class="upload-img" style="background:url'+"('" +img+ "')" + ' no-repeat center;background-size:cover;"></div>';
                    $('#imgsrc').val(data.imgsrc);
                    $('#mark').before(html);
                    var count = $('#count').val();
                    $('#count').val(parseInt(count)+1);

                    if(count == 2){
                        $('#uploadfile').hide();
                    }


                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });
        });

        /*
        $(".upload-file").change(function(){
            var length = $(".sale-upload>div").length;
            $(this).before('<div class="upload-img" style="background:url('+"'{{ asset('images/upload-img.png') }}'"+') no-repeat center;background-size:cover;"><div></div><input type="file"></div>');
            if(length==3){
                $(".sale-upload>div:last-child").remove();
            }
        });
        */
        $(".score img").click(function(){
            var index = $(this).index()+1;
            var length = $(".score img").length;
            if($(this).hasClass("star")){
                for(var i=(index+1);i<=length;i++){
                    $(".score img:nth-child("+i+")").removeClass("star").attr("src","{{ asset('images/no-stars.png') }}");
                }
            }else{
                for(var i=1;i<=index;i++){
                    $(".score img:nth-child("+i+")").addClass("star").attr("src","{{ asset('images/stars.png') }}");
                }
            }

        });
    });

    function tiaozhuanorder(){
        var url ='{{ url('home/myorder') }}';
        //alert(url);return false;
        location.href=url;
    }
</script>
</body>
</html>


