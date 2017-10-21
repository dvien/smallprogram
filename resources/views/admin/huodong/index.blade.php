@extends('layouts.admin_common')
@section('right-box')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >

        <h1 class="page-header">
            {{ $type }}列表
        </h1>

        <h1 class="page-header">管理 <span class="badge">{{ count($res) }}</span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" >
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">发布人</span></th>

                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">标题</span></th>
                    <th style="width:200px;"><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">{{ $type }}内容</span></th>
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">点赞数</span></th>
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">状态</span></th>
                    @if($index == 1)
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">解决状态</span></th>
                    @endif
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">发布时间</span></th>

                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
                </thead>

                <tbody>
                @unless(!$res)
                    @foreach($res as $vo)
                        <tr>
                            <td>{{$vo -> id}}</td>
                            <td>{{$vo -> userinfo -> name}}</td>
                            <td>{{$vo -> title}}</td>
                            <td>{{$vo -> miaoshu}}</td>
                            <td>{{$vo -> dianzan}}</td>
                            <td>@if($vo -> flag == 1)隐藏@else显示@endif</td>
                            @if($index == 1)
                            <td>@if($vo -> status == 1)已解决@else未解决@endif</td>
                            @endif
                            <td>{{ date('Y-m-d H:i',$vo -> created_at) }}</td>
                            <td data="{{$vo -> id}}"><a  name="edit"  href="{{ url('admin/checkPinlun',['id'=>$vo -> id]) }}">查看评论</a>@if($vo -> flag  == 0)<a href="{{ url('admin/changeLinli',['id'=>$vo -> id,'flag' => $vo -> flag,'index' => $index ]) }}"> 隐藏</a> @else <a href="{{ url('admin/changeLinli',['id'=>$vo -> id,'flag' => $vo -> flag,'index' => $index ]) }}" > 显示</a>@endif </td>
                        </tr>
                    @endforeach
                @endunless
                </tbody>

                <tfoot>
                <tr>
                    <td colspan="5">{{ $res -> links() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>





    <script>
        @if (session('insertres'))
            alert('添加成功！');
        @endif
        @if (session('editres'))
            alert('修改成功！');
        @endif

    </script>
    <script>
        $(function(){
            @if (session('show'))
                $('#editShequ').modal('show')
            @endif

            //数据验证
            $('#myAddShequForm').submit(function(){

                if($.trim($('#myAddShequForm input[name=password]').val()) && $.trim($('#myAddShequForm input[name=password]').val()) != $.trim($('#myAddShequForm input[name=new_password]').val())){
                    alert('两次填写密码不一致');return false;
                }
            })
            $('#myEditShequForm').submit(function(){

                if($.trim($('#myEditShequForm input[name=password]').val()) != $.trim($('#myEditShequForm input[name=new_password]').val())){
                    alert('两次填写密码不一致');return false;
                }
            })

            $("#main table tbody tr td a").click(function () {
                var name = $(this);
                var id = name.parent().attr("data"); //对应id
                if (name.attr("name") === "delete") {
                    if (window.confirm("此操作不可逆，是否确认？")) {

                        var url = '{{ url('admin/deleteShequ') }}';

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id:id},
                            //dataType:'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data){
                                if(data == 'success'){
                                    alert('删除成功');
                                    location.reload();
                                }
                            },
                            error: function(xhr, type){
                                alert('Ajax error!')
                            }
                        });
                    };
                };
            });
        })
    </script>
@stop