<link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/font-awesome.min.css')}}">
<script src="{{asset('admin/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('layer/2.2/layer.js')}}"></script>
<meta name="_token" content="{{ csrf_token() }}" />
<style>
    .box div{
        padding-left:10px;
        height:30px;
        line-height:30px;
    }
</style>
<body style="padding-top:5px;">
<div style="width:100%;height: 100%;"   class="box">
    <form action="{{ url('admin/user/shenfen') }}" >
        <input type="hidden" name="id" value="{{ $id }}" />
        <div>请设置身份</div>
        <div><label><input type="radio" name="shenfen" value="0" @if($res -> shenfen == 0) checked @endif />产权人</label></div>
        <div><label><input type="radio" name="shenfen" value="1" @if($res -> shenfen == 1) checked @endif />居民</label></div>
        <div><label><input type="radio" name="shenfen" value="2" @if($res -> shenfen == 2) checked @endif />业委会主任</label></div>
        <div><label><input type="radio" name="shenfen" value="3" @if($res -> shenfen == 3) checked @endif />业委会副主任</label></div>
        <div><label><input type="radio" name="shenfen" value="4" @if($res -> shenfen == 4) checked @endif />业委会秘书</label></div>
        <div><label><input type="radio" name="shenfen" value="5" @if($res -> shenfen == 5) checked @endif />业委会委员</label></div>
        <div><label><input type="radio" name="shenfen" value="6" @if($res -> shenfen == 6) checked @endif />业主代表</label></div>
        <div><label><input type="radio" name="shenfen" value="7" @if($res -> shenfen == 7) checked @endif />社区管理员</label></div>
        <div><button class="btn btn-default" type="button" id="queding">确定</button></div>
    </form>
</div>
<script>
    $(function(){
        $('#queding').click(function(){
            var id =  '{{ $id }}';
            var url = '{{ url('admin/user/shenfen') }}'
            var shenfen = $('input[name=shenfen]:checked').val();
            //设置身份
            $.ajax({
                type: 'POST',
                url: url,
                data: {id:id,shenfen:shenfen},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    alert('设置成功');
                    parent.location.reload();
                    /*
                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                    parent.layer.close(index);
                    */
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });


        })
    })
</script>
</body>