<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.common')
    <title>商户登陆</title>

</head>
<body>
<style>
    body{background:#fff;}
</style>

<header class="public-header">

    <i class="iconfont icon-fanhui" style="display:none;"></i>

    <img src="{{asset('images/logo.png')}}" />
</header>

<article class="community-details">
    @if(!empty($res))
        @foreach($res as $vo)

            <section class="comment-title"  >
                <header class="comment-head flex-justify"  onclick="location.href='{{url('home/pinlun').'/'.$vo['id']}}' " >
                    <h3>{{ $vo['title'] }}@if(!empty($vo['label']))<span class="hygiene">{{ $vo['label'] }}</span>@endif @if(!empty($vo['huifu']))<span @if($vo['status'] == 0)class="pending"@else class="resolved"@endif >@if($vo['status'] == 0)待解决@else已解决@endif</span>@endif</h3>
                    <span>{{ $vo['userinfo'] -> name }}</span>
                </header>
                <p onclick="location.href='{{url('home/pinlun').'/'.$vo['id']}}' " >{{ $vo['miaoshu'] }}</p>
                @if(!empty($vo['img']))
                    <div class="comment-img clearfix" onclick="location.href='{{url('home/pinlun').'/'.$vo['id']}}' " >
                        @foreach($vo['img'] as $vol)
                            <div style="background:url('{{asset('images').'/'.$vol}}') no-repeat center;background-size:cover;"></div>
                        @endforeach
                    </div>
                @endif
                <footer class="comment-foot flex-justify">
                    <span>{{ date('Y-m-d H:i',$vo['created_at'] ) }}</span>
                    <div>
                        <i class="iconfont icon-good"></i>
                        <span>{{ $vo['dianzan'] }}</span>
                        <img src="{{asset('images/comment.png')}}" />
                        <span>{{ $vo['liulan'] }}</span>
                    </div>
                </footer>
                @if(!empty($vo['huifu']))
                    <div class="property-reply">社区管理员：{{$vo['huifu']}}</div>
                @endif
                @if(!empty($vo['wuyehuifu']))
                    @foreach($vo['wuyehuifu'] as $vol)
                    <div class="property-reply">物业：{{$vol -> content}}</div>
                    @endforeach
                @endif

                <div class="feedback">
                    <form id="myForm-{{ $vo['id'] }}" >
                        <div class="feedback-main">
                            <textarea placeholder="请在此回复反馈" name="content" id="content-{{ $vo['id'] }}"></textarea>
                            <div class="sale-upload clearfix" data="{{ $vo['id'] }}" style="display:none;">
                                <a id="mark-{{ $vo['id'] }}" style="display: none;"></a>
                                <div class="upload-file" id="uploadfile-{{ $vo['id'] }}" ><input type="file" name="file" /></div>
                            </div>
                            <a class="huifu" data="{{ $vo['id'] }}" >回复</a>
                        </div>
                    </form>
                    <div class="feedback-solve"><a class="submitform" data="{{ $vo['id'] }}" >确认已解决</a></div>
                </div>

                <!-- 计数 -->
                <input type="hidden" id="count-{{ $vo['id'] }}" value="0" />
                <input type="hidden" id="imgsrc-{{ $vo['id'] }}"value="" />
            </section>
        @endforeach
    @endif
</article>
<!-- 计数 -->
<input type="hidden" id="count" value="0" />

</body>
<script>

    $(function(){
        //提交回复
        $('.huifu').click(function(){
            var number = $(this).attr('data');
            var content = $('#content-'+number).val();
            var img = $('#imgsrc'+number).val();
            if(!content){
                layer.alert('请填写内容');return false;
            }
            var url = '{{ url('home/wuye/wuyehuifu') }}';
            //将图片和内容上传
            $.ajax({

                type: 'POST',
                url: url,
                data: {id:number,content:content,img:img},
                //dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                success: function(data){
                    layer.msg('回复成功');
                    location.reload();

                },
                error: function(xhr, type){
                    //alert('Ajax error!')
                }
            });

        })



        $(".upload-file").change(function(){
            var number = $(this).parent('.clearfix').attr('data');
            var i = "myForm-" + number;

            var formData = new FormData(document.getElementById(i));
            //console.info(formData);
            var url = '{{url('home/saveImg')}}';
            //alert(url);
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
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
                success: function(data){
                    var img = '{{asset('images')}}'+'/'+data.img;
                    //alert(img);
                    var length = $(".sale-upload>div").length;
                    var html = '<div class="upload-img" style="background:url'+"('" +img+ "')" + ' no-repeat center;background-size:cover;"></div>';
                    
                    //存放路径
                    $('#imgsrc-'+number).val(data.imgsrc);
                    $('#mark-'+number).before(html);
                    var count = $('#count-'+number).val();
                    $('#count-'+number).val(parseInt(count)+1);

                    if(count == 2){
                        $('#uploadfile-'+number).hide();
                    }


                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });
        });


        //确认已解决
        $('.submitform').click(function(){
            var id = $(this).attr('data');
            layer.confirm('确认已解决后，该条信息将从这里移除，<br>如未解决可能会让业主不满，您要确认吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){

                //alert(id);return false;
                var url = '{{ url('home/wuye/jiejue') }}';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {id:id},

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(data){
                        if(data == 'success'){
                            layer.msg('已完成');
                            location.reload();
                        }
                    },
                    error: function(xhr, type){
                        //alert('Ajax error!')
                    }
                });


            }, function(){

                layer.msg('您已取消', {time:200});


            });
        })
    })

</script>

<script>
    $(function(){
        $('#top-nav a').click(function(){
            var index = $(this).index();
            $('#top-nav a').removeClass('hover');
            $(this).addClass('hover');
            $('.customer-main').hide();
            $('#box-'+index).show();
        })

        $('#fabufuwu').click(function(){
            $('#box-1').hide();
            $('#box-2').show();
            $('.icon-fanhui').show();
        })

        $('#box-2 #selectxiaoqu').click(function(){
            $('#box-2').hide();
            $('#box-3').show();
        })

        //保存选中的服务
        $('#box-3 #save').click(function(){
            $('#xiaoqu-box').empty();
            $("input[name=xiaoqus]:checked").each(function(){
                $('#xiaoqu-box').append('<span>'+$(this).attr('data')+'</span>');
            });
            $('#box-2').show();
            $('#box-3').hide();
            $('#xiaoqu-bbox').show();
        })
    })
</script>
</html>


