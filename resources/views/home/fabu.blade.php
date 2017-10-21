<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
</head>
<body>
@include('layouts.common_fanhui')

@if($index == 0)
<article class="sale">
    <form id="myForm">
        <section>
            <input type="text" placeholder="请输入标题（25字以内）" maxlength="25" name="title"/>
            <ul class="clearfix">
                <li>
                    <input type="radio" name="label" checked="checked" value="业主生活"/>
                    <a href="javascript:;">业主生活</a>
                </li>
                <li>
                    <input type="radio" name="label" value="小区管理"/>
                    <a href="javascript:;">小区管理</a>
                </li>
                <li>
                    <input type="radio" name="label" value="环境卫生"/>
                    <a href="javascript:;">环境卫生</a>
                </li>
                <li>
                    <input type="radio" name="label" value="房屋设备"/>
                    <a href="javascript:;">房屋设备</a>
                </li>
                <li>
                    <input type="radio" name="label" value="消防安全"/>
                    <a href="javascript:;">消防安全</a>
                </li>
                <li>
                    <input type="radio" name="label" value="安保车辆"/>
                    <a href="javascript:;">安保车辆</a>
                </li>
                <li>
                    <input type="radio" name="label" value="服务配合"/>
                    <a href="javascript:;">服务配合</a>
                </li>
                <li>
                    <input type="radio" name="label" value="其它" />
                    <a href="javascript:;">其它</a>
                </li>
            </ul>
        </section>
        <div class="sale-text">
            <textarea placeholder="为了保证用户体验，请确保发言内容与本版块主题相符，违规者无条件删帖，敬请谅解！（300字内）" id="content"></textarea>
            <div class="sale-upload clearfix">
                <a id="mark"></a>
                <div class="upload-file" id="uploadfile" ><input type="file" name="file" /></div>
            </div>
        </div>
        <a  class="publish" id="publish0">发表</a>
        <!-- 存放图片路径 -->
        <input type="hidden" id="imgsrc" name="imgsrc" value="" />
    </form>
</article>
@endif

<!-- 友邻互助 -->
@if($index == 1)
    <article class="sale">
        <form id="myForm">
            <section>
                <div class="flex-justify remuneration">
                    <div><input type="tel" placeholder="请输入酬金" name="price"/> <span>元</span></div>
                    <div><span>或</span><a >面议</a></div>
                </div>
                <input type="text" class="help-title" placeholder="请输入标题（25字以内）" name="title"/>
                <input type="date" class="help-date" id="date"/>
            </section>

            <div class="sale-text">
                <textarea placeholder="为了保证用户体验，请确保发言内容与本版块主题相符，违规者无条件删帖，敬请谅解！（300字内）" id="content"></textarea>
                <div class="sale-upload clearfix">
                    <a id="mark"></a>
                    <div class="upload-file" id="uploadfile" ><input type="file" name="file" /></div>
                </div>
            </div>
            <a  class="publish" id="publish1">发表</a>
            <!-- 存放图片路径 -->
            <input type="hidden" id="imgsrc" name="imgsrc" value="" />
        </form>
    </article>
@endif


<!-- 社区活动 -->
@if($index == 2)
    <article class="sale">
        <form id="myForm">
            <section>
                <input type="text" placeholder="请输入标题（25字以内）" maxlength="25" name="title"/>

            </section>
            <div class="sale-text">
                <textarea placeholder="为了保证用户体验，请确保发言内容与本版块主题相符，违规者无条件删帖，敬请谅解！（300字内）" id="content"></textarea>
                <div class="sale-upload clearfix">
                    <a id="mark"></a>
                    <div class="upload-file" id="uploadfile" ><input type="file" name="file" /></div>
                </div>
                <div class="upload-tips"><i class="iconfont icon-gantanhao"></i>建议上传一张微信群二维码图片</div>
            </div>

            <a  class="publish" id="publish2">发表</a>
            <!-- 存放图片路径 -->
            <input type="hidden" id="imgsrc" name="imgsrc" value="" />
        </form>
    </article>
@endif

<!-- 共享车位 -->
@if($index == 3)
    <article class="sale">
        <form id="myForm">
            <section>
                <div class="flex-justify remuneration">
                    <div><input type="tel" placeholder="请输入价格" name="price"/> <span>元</span></div>

                </div>
                <input type="text" class="help-title" placeholder="请输入标题（25字以内）" name="title"/>
                <div class="help-time">
                    <input type="date" id="date"/>
                    <span>至</span>
                    <input type="date"  id="date_right"/>
                </div>
            </section>
            <div class="sale-text">
                <textarea placeholder="为了保证用户体验，请确保发言内容与本版块主题相符，违规者无条件删帖，敬请谅解！（300字内）" id="content"></textarea>
                <div class="sale-upload clearfix">
                    <a id="mark"></a>
                    <div class="upload-file" id="uploadfile" ><input type="file" name="file" /></div>
                </div>
            </div>
            <a  class="publish" id="publish3">发表</a>
            <!-- 存放图片路径 -->
            <input type="hidden" id="imgsrc" name="imgsrc" value="" />
        </form>
@endif
<!-- 跳蚤市场 -->
@if($index == 4)
    <article class="sale">
        <form id="myForm">
            <section>
                <input type="text" placeholder="请输入标题（25字以内）" maxlength="25" name="title"/>

            </section>
            <div class="sale-text">
                <textarea placeholder="为了保证用户体验，请确保发言内容与本版块主题相符，违规者无条件删帖，敬请谅解！（300字内）" id="content"></textarea>
                <div class="sale-upload clearfix">
                    <a id="mark"></a>
                    <div class="upload-file" id="uploadfile" ><input type="file" name="file" /></div>
                </div>

            </div>

            <a  class="publish" id="publish_market">发表</a>
            <!-- 存放图片路径 -->
            <input type="hidden" id="imgsrc" name="imgsrc" value="" />
        </form>
    </article>
@endif


<!-- 计数 -->
<input type="hidden" id="count" value="0" />


<script>
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
                layer.msg('网络出错');
            }
        });
    });
</script>
<script>
    $(function(){
        $('#publish0').click(function(){
            var title = $('input[name=title]').val();
            var label = $('input[name=label]:checked').val();
            var content = $('#content').val();
            var img = $('#imgsrc').val();

            if(!title){
                layer.msg('请填写标题');return false;
            }
            if(!content){
                layer.msg('请填写内容');return false;
            }
            var index = '{{$index}}';
            var url = '{{url('home/fabuRes')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {title:title,content:content,index:index,label:label,img:img},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    layer.msg('发布成功');
                    @if($index != 4)
                    setTimeout(function () {
                        location.href='{{ url('home') }}';
                    }, 1000);
                    @else
                    setTimeout(function () {
                        location.href='{{ url('home/market') }}';
                    }, 1000);
                    @endif

                },
                error: function(xhr, type){
                    layer.msg('Ajax error!')
                }
            });

        })


        $('#publish1').click(function(){
            var title = $('input[name=title]').val();
            var price = $('input[name=price]').val();
            var content = $('#content').val();
            var img = $('#imgsrc').val();
            var date = $('#date').val();

            if(!title){
                layer.msg('请填写标题');return false;
            }
            if(!content){
                layer.msg('请填写内容');return false;
            }
            if(!date){
                layer.msg('请填写日期');return false;
            }

            var index = '{{$index}}';
            var url = '{{url('home/fabuRes')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {title:title,content:content,index:index,price:price,img:img,date:date},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    layer.msg('发布成功');
                    setTimeout(function () {
                        location.href='{{ url('home') }}';
                    }, 1000);
                },
                error: function(xhr, type){
                    layer.msg('网络出错');
                }
            });

        });

        //社区活动
        $('#publish2').click(function(){
            var title = $('input[name=title]').val();
            var content = $('#content').val();
            var img = $('#imgsrc').val();

            if(!title){
                layer.msg('请填写标题');return false;
            }
            if(!content){
                layer.msg('请填写内容');return false;
            }
            var index = '{{$index}}';
            var url = '{{url('home/fabuRes')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {title:title,content:content,index:index,img:img},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    layer.msg('发布成功');
                    setTimeout(function () {
                        location.href='{{ url('home') }}';
                    }, 1000);
                },
                error: function(xhr, type){
                    layer.msg('网络出错');
                }
            });

        });

        //共享车位
        $('#publish3').click(function(){
            var title = $('input[name=title]').val();
            var price = $('input[name=price]').val();
            var content = $('#content').val();
            var img = $('#imgsrc').val();
            var date = $('#date').val();
            var date_right = $('#date_right').val();

            if(!title){
                layer.msg('请填写标题');return false;
            }
            if(!content){
                layer.msg('请填写内容');return false;
            }
            if(!date){
                layer.msg('请填写日期');return false;
            }
            if(!date_right){
                layer.msg('请填写日期');return false;
            }

            var index = '{{$index}}';
            var url = '{{url('home/fabuRes')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {title:title,content:content,index:index,price:price,img:img,date:date,date_right:date_right},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    layer.msg('发布成功');
                    setTimeout(function () {
                        location.href='{{ url('home') }}';
                    }, 1000);
                },
                error: function(xhr, type){
                    layer.msg('网络出错');
                }
            });

        });


        //跳蚤市场
        $('#publish_market').click(function(){
            var title = $('input[name=title]').val();
            var content = $('#content').val();
            var img = $('#imgsrc').val();
            if(!title){
                layer.msg('请填写标题');return false;
            }
            if(!content){
                layer.msg('请填写内容');return false;
            }
            var index = '{{$index}}';
            var url = '{{url('home/marketfabuRes')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {title:title,content:content,index:index,img:img},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data == 'success'){
                        layer.msg('发布成功');
                        setTimeout(function () {
                            location.href='{{ url('home/market') }}';
                        }, 1000);

                    }
                },
                error: function(xhr, type){
                    layer.msg('网络出错');
                }
            });


        })




    })
</script>
</body>
</html>


