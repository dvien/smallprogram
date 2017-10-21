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
<article class="sale">
    <form id="myForm">
        <div class="return-goods">
            <span>退货金额</span><input type="tel" class="flex-1" placeholder="请输入退款金额" price />
        </div>
        <div class="sale-text return-goods-text">
            <h3>退货说明</h3>
            <textarea placeholder="请输入退货说明" id="content"></textarea>
            <div class="sale-upload clearfix">
                <a id="mark"></a>
                <div class="upload-file" id="uploadfile" ><input type="file" name="file" /></div>
            </div>
        </div>
        <a class="publish">提交申请</a>

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

            var url = '{{ url('home/myorder/tuikuanRes') }}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {content:content,img:img,orderid:orderid},
                //dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        layer.msg('发送成功');
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




    });

    function tiaozhuanorder(){
        var url ='{{ url('home/myorder') }}';
        //alert(url);return false;
        location.href=url;
    }
</script>
</body>
</html>


